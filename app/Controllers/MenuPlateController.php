<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\MenuModel;
use App\Models\MenuPlateModel;
use App\Models\PlateModel;


use Exception;

class MenuPlateController extends BaseController
{

  public function index($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();
    $plateModel = new PlateModel();

    try {
      $menuRole = session()->get('userRole');

      if (!$menuRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper');

      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $sortBy = $this->request->getGet('sortBy') ?? 'name';
      $data['sortBy'] = $sortBy;

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';
      $data['sortDirection'] = $sortDirection;


      $data['menu'] = $menuModel->select('id, name, disabled')->find($id);
      $data['plates'] = $plateModel->select('id, name, price, category,disabled')->where('disabled', null)->findAll();

      $data = array_merge($data, $menuPlateModel->getPlatesByMenu($id, $perPage, $searchParams, $sortBy, $sortDirection));

      $queryString = http_build_query([
        'searchParams' => $searchParams,
        'sortBy' => $sortBy,
        'sortDirection' => $sortDirection,
        'perPage' => $perPage,
      ]);

      $data['exportUrl'] = base_url('./menu_platess/export/' . $id) . '?' . $queryString;



      return view('pages/list/menu_plates_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function getPlatesInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();


    try {
      $menu = $menuModel->find($id);

      $menuPlates = $menuPlateModel->where('id_menu', $id)->findAll();



      $plates = array_map(function ($plate) {

        return ['id' => $plate['id_plate'], 'amount' => $plate['amount']];
      }, $menuPlates);



      if ($menu) {
        return $this->response->setStatusCode(200)->setJSON(['success' => true, 'menu' => $menu, 'plates' => $plates]);
      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'menu not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting menu: ' . $e->getMessage()]);
    }
  }


  public function savePlateInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'selectedPlates' => 'required',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
      } else {


        $selectedPlates =  json_decode($this->request->getPost('selectedPlates'), true);

        $menu = $menuModel->find($id);


        if (!$menu) {
          return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Menu not found']]);
        } else if ($menu['disabled'] !== null) {
          return $this->response->setStatusCode(403)->setJSON(['errors' => ['id' => 'Menu is disabled']]);
        }


        $currentPlates = $menuPlateModel->where('id_menu', $id)->findAll();

        $currentPlateIds = array_map(function ($plate) {
          return $plate['id_plate'];
        }, $currentPlates);

        $selectedPlateIds = array_map(function ($plate) {
          return $plate['id'];
        }, $selectedPlates);



        foreach ($selectedPlates as $plate) {

          if (in_array($plate['id'], $currentPlateIds)) {

            $menuPlateModel->set(['amount' => $plate['count']])
              ->where('id_menu', $id)
              ->where('id_plate', $plate['id'])
              ->update();
          } else {

            $menuPlateModel->save([
              'id_menu' => $id,
              'id_plate' => $plate['id'],
              'amount' => $plate['count']
            ]);
          }
        };

        foreach ($currentPlates as $currentPlate) {
          if (!in_array($currentPlate['id_plate'], $selectedPlateIds)) {
            $menuPlateModel->where('id_menu', $id)->where('id_plate', $currentPlate['id_plate'])->delete();
          }
        }

        return $this->response->setStatusCode(200)->setJSON(['success' => true]);
      }
    } catch (Exception $e) {

      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON([$selectedPlates, 'success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


  public function deletePlatesInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    try {

      if (!$menuModel->find($id)) {
        return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Menu not found']]);
      }

      $ids = $this->request->getPost('ids');



      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }


      if (!$menuPlateModel->where('id_menu', $id)->whereIn('id_plate', $ids)->delete()) {

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete relation']);
      }


      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


  public function exportPlatesInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();
    $spreadsheet = new Spreadsheet();

    try {


      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Name of Menu');
      $sheet->setCellValue('A2', 'NAME');
      $sheet->setCellValue('B2', 'DESCRIPTION');
      $sheet->setCellValue('C2', 'PRICE');
      $sheet->setCellValue('D2', 'CATEGORY');
      $sheet->setCellValue('E2', 'AMOUNT');
      $sheet->setCellValue('F2', 'PREPARATION TIME');




      $searchParams = $this->request->getGet('searchParams') ?? [];
      $searchParams['all'] = 'true';

      $sortBy = $this->request->getGet('sortBy') ?? 'name';

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';


      $menu = $menuModel->select('id, name')->find($id);
      $data = $menuPlateModel->getPlatesByMenu($id, null, $searchParams, $sortBy, $sortDirection);

      $sheet->setCellValue('B1', $menu['name']);

      $rowNumber = 3;

      foreach ($data as $row) {

        $sheet->setCellValue('A' . $rowNumber, $row['name']);
        $sheet->setCellValue('B' . $rowNumber, $row['description']);
        $sheet->setCellValue('C' . $rowNumber, $row['price'] . " $");
        $sheet->setCellValue('D' . $rowNumber, $row['category']);
        $sheet->setCellValue('E' . $rowNumber, $row['amount']);
        $sheet->setCellValue('F' . $rowNumber, $row['preparation_time'] . " min");

        if (!is_null($row['disabled'])) {
          $sheet->getStyle('A' . $rowNumber . ':F' . $rowNumber)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF6666');

          $sheet->getStyle('A' . $rowNumber . ':F' . $rowNumber)->getFont()
            ->getColor()->setARGB('FFFFFFFF');
        }
        

        $rowNumber++;
      }

      $writer = new Xlsx($spreadsheet);
      $filename = 'exportPlatesInMenu.xlsx';

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
      exit;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
