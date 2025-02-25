<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\RolModel;
use Exception;


class RolController extends BaseController
{

  public function index()
  {
    $rolModel = new RolModel();

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


      $data = array_merge($data, $rolModel->getRoles($perPage, $searchParams, $sortBy, $sortDirection));


      $queryString = http_build_query([
        'searchParams' => $searchParams,
        'sortBy' => $sortBy,
        'sortDirection' => $sortDirection,
        'perPage' => $perPage,
      ]);

      $data['exportUrl'] = base_url('./roles/export') . '?' . $queryString;

      return view('pages/list/rol_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  public function getRol($id)
  {
    $rolModel = new RolModel();

    try {

      $role = $rolModel->find($id);





      if ($role) {

        if ($role['disabled'] !== null) {
          return $this->response->setStatusCode(400)->setJSON(['errors' => 'This role is not editable because it is disabled.']);
        } else {
          return $this->response->setStatusCode(200)->setJSON(['success' => $role]);
        }
      } else {
        return $this->response->setStatusCode(400)->setJSON(['errors' => 'Role not found.']);
      }
    } catch (Exception $e) {
      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting role: ' . $e->getMessage()]);
    }
  }


  public function saveRol($id = null)
  {
    $rolModel = new RolModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|alpha_space|min_length[3]|max_length[255]',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
      } else {

        $rolData = [
          'name' => ucfirst($this->request->getPost('name'))
        ];


        if ($rolModel->where('name', $rolData['name'])->first()) {
          return $this->response->setStatusCode(404)->setJSON(['errors' => ['name' => 'The role name is already in use']]);
        }




        if ($id !== null) {

          if (!$rolModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Role not found']]);
          }



          if ($rolModel->update($id, $rolData)) {
            return $this->response->setStatusCode(200)->setJSON(['success' => true]);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['name' => 'Failed to updated rol']]);
          }
        } else {

          if ($rolModel->save($rolData)) {
            return $this->response->setStatusCode(200)->setJSON(['success' => true]);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['name' => 'Failed to add rol']]);
          }
        }
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }

  public function deleteRol()
  {
    $rolModel = new RolModel();

    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }


      if ($rolModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => true]);
      } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Roles not found']);
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function restoreRol()
  {
    $rolModel = new RolModel();

    try {
      $id = $this->request->getPost('id');

      if (empty($id)) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }

      if ($rolModel->update($id, ['disabled' => null])) {

        return $this->response->setJSON(['success' => true]);
      } else {

        return $this->response->setJSON(['success' => false, 'message' => 'Roles not found']);
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function exportRol()
  {
    $rolModel = new RolModel();
    $spreadsheet = new Spreadsheet();

    try {
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'NAME');



      $searchParams = $this->request->getGet('searchParams') ?? [];
      $searchParams['all'] = 'true';

      $sortBy = $this->request->getGet('sortBy') ?? 'name';

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';


      $data = $rolModel->getRoles( null, $searchParams, $sortBy, $sortDirection);

      $rowNumber = 2;

      foreach ($data as $row) {

        $sheet->setCellValue('A' . $rowNumber, $row['name']);

        if (!is_null($row['disabled'])) {
          $sheet->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB('FFFF6666'); 

          $sheet->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getFont()
              ->getColor()->setARGB('FFFFFFFF'); 
      }

        $rowNumber++;
      }

      $writer = new Xlsx($spreadsheet);
      $filename = 'exportRol.xlsx';

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
