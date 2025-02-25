<?php

namespace App\Controllers;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PlateModel;
use App\Models\StoreModel;
use App\Models\IngredientModel;

use Exception;


class StoreController extends BaseController
{

  public function index($id)
  {

    $plateModel = new PlateModel();
    $storeModel = new StoreModel();
    $ingredientModel = new IngredientModel();

    try {
      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper');


      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $sortBy = $this->request->getGet('sortBy') ?? 'name';
      $data['sortBy'] = $sortBy;

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';
      $data['sortDirection'] = $sortDirection;


      $data['plate'] = $plateModel->select('id, name, disabled')->find($id);
      $data['ingredients'] = $ingredientModel->select('id, name')->where('disabled', null)->findAll();


      $data = array_merge($data, $storeModel->getIngredientsByPlate($id, $perPage, $searchParams, $sortBy, $sortDirection));

      $queryString = http_build_query([
        'searchParams' => $searchParams,
        'sortBy' => $sortBy,
        'sortDirection' => $sortDirection,
        'perPage' => $perPage,
      ]);

      $data['exportUrl'] = base_url('./storer/export/' . $id) . '?' . $queryString;




      return view('pages/list/store_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }



  public function getPlatesInMenu($id)
  {
    $storeModel = new StoreModel();

    try {

      $plateIngredients = $storeModel->where('id_plate', $id)->findAll();


      $plates = array_column($plateIngredients, 'id_ingredient');


      if ($plates) {
        return $this->response->setStatusCode(200)->setJSON(['success' => true, 'plates' => $plates]);
      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'menu not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting menu: ' . $e->getMessage()]);
    }
  }


  public function saveIngredientInPlate($id)
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'selectedIngredients' => 'required',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
      } else {


        $selectedIngredients =  json_decode($this->request->getPost('selectedIngredients'), true);


        if (!$plateModel->find($id)) {
          return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Plate not found']]);
        }


        $currentIngredients = $storeModel->select('id_ingredient')->where('id_plate', $id)->findAll();


        $currentIngredientIds = array_column($currentIngredients, 'id_ingredient');


        foreach ($selectedIngredients as $ingredientId) {


          if (!in_array($ingredientId, $currentIngredientIds)) {

            $storeModel->save([
              'id_plate' => $id,
              'id_ingredient' => $ingredientId
            ]);
          }
        };

        foreach ($currentIngredientIds as $ingredientId) {

          if (!in_array($ingredientId, $selectedIngredients)) {

            $storeModel->where('id_plate', $id)->where('id_ingredient', $ingredientId)->delete();
          }
        }

        return $this->response->setStatusCode(200)->setJSON(['success' => true]);
      }
    } catch (Exception $e) {

      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }




  public function deleteIngredientsInPlate($id)
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();

    try {

      if (!$plateModel->find($id)) {
        return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Plate not found']]);
      }

      $ids = $this->request->getPost('ids');



      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }


      if (!$storeModel->where('id_plate', $id)->whereIn('id_ingredient', $ids)->delete()) {

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete relation']);
      }


      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }



  public function exportIngredientsInPlate($id)
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();
    $spreadsheet = new Spreadsheet();

    try {


      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Name of Plate');
      $sheet->setCellValue('A2', 'NAME');
      $sheet->setCellValue('B2', 'ALLERGENS');





      $searchParams = $this->request->getGet('searchParams') ?? [];
      $searchParams['all'] = 'true';

      $sortBy = $this->request->getGet('sortBy') ?? 'name';

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';


      $plate = $plateModel->select('id, name')->find($id);
      $data = $storeModel->getIngredientsByPlate($id, null, $searchParams, $sortBy, $sortDirection);

      $sheet->setCellValue('B1', $plate['name']);

      $rowNumber = 3;

      foreach ($data as $row) {
        
        $allergens = json_decode($row['allergens'], true); 
        if (!is_array($allergens)) { 
          $allergens = ['none'];
        }


        $sheet->setCellValue('A' . $rowNumber, $row['name']);
        $sheet->setCellValue('B' . $rowNumber, implode(', ', $allergens));


        if (!is_null($row['disabled'])) {
          $sheet->getStyle('A' . $rowNumber . ':B' . $rowNumber)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF6666');

          $sheet->getStyle('A' . $rowNumber . ':B' . $rowNumber)->getFont()
            ->getColor()->setARGB('FFFFFFFF');
        }


        $rowNumber++;
      }

      $writer = new Xlsx($spreadsheet);
      $filename = 'exportIngredientInPlate.xlsx';

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
