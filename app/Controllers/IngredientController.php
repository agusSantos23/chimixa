<?php

namespace App\Controllers;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\IngredientModel;
use App\Models\StoreModel;

use Exception;



class IngredientController extends BaseController
{

  public function index()
  {
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

      $data = array_merge($data, $ingredientModel->getIngredients($perPage, $searchParams, $sortBy, $sortDirection));

      $queryString = http_build_query([
        'searchParams' => $searchParams,
        'sortBy' => $sortBy,
        'sortDirection' => $sortDirection,
        'perPage' => $perPage,
      ]);

      $data['exportUrl'] = base_url('./ingredients/export') . '?' . $queryString;


      return view('pages/list/ingredient_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  public function getIngredient($id)
  {
    $ingredientModel = new IngredientModel();

    try {

      $ingredient = $ingredientModel->find($id);

      if ($ingredient) {

        if ($ingredient['disabled'] !== null) {

          return $this->response->setStatusCode(400)->setJSON(['errors' => 'This ingredient is not editable because it is disabled.']);
        } else {

          if (!empty($ingredient['expiration_date'])) {
            $ingredient['expiration_date'] = date('d/m/Y', strtotime($ingredient['expiration_date']));
          }

          return $this->response->setStatusCode(200)->setJSON(['success' => $ingredient]);
        }
      } else {
        return $this->response->setStatusCode(400)->setJSON(['errors' => 'Role not found']);
      }
    } catch (Exception $e) {
      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting ingredient: ' . $e->getMessage()]);
    }
  }



  public function saveIngredient($id = null)
  {
    $ingredientModel = new IngredientModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'quantityAvailabe' => 'required|decimal|greater_than_equal_to[1]',
      'measure' => 'required|in_list[ g, kg, oz, lb, cda, u]',
      'expirationDate' => 'permit_empty|valid_date[d/m/Y]',
      'price' => 'required|decimal|greater_than_equal_to[1]|less_than_equal_to[99999999.99]',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
      } else {

        $ingredientData = [
          'name' => $this->request->getPost('name'),
          'quantity_available' => $this->request->getPost('quantityAvailabe'),
          'measure' => $this->request->getPost('measure'),
          'price' => $this->request->getPost('price'),
        ];

        $expirationDate = $this->request->getPost('expirationDate');
        if (!empty($expirationDate)) {
          $ingredientData['expiration_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $expirationDate)));
        }


        $allergens = $this->request->getPost('allergens');
        if (!empty($allergens)) {
          $allergensDecode = json_decode($allergens, true);

          $ingredientData['allergens'] = json_encode(array_map(function ($item) {
            return $item['value'];
          }, $allergensDecode));
        }



        if ($id !== null) {


          if (!$ingredientModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Ingredient not found']]);
          }



          if ($ingredientModel->update($id, $ingredientData)) {
            return $this->response->setStatusCode(200)->setJSON(['success' => true]);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['name' => 'Failed to updated ingredient']]);
          }
        } else {

          if ($ingredientModel->where('name', $ingredientData['name'])->first()) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['This name is already registered']]);
          }

          if ($ingredientModel->save($ingredientData)) {
            return $this->response->setStatusCode(200)->setJSON(['success' => true, $ingredientData]);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['Failed to add rol']]);
          }
        }
      }
    } catch (Exception $e) {
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


  public function deleteIngredient()
  {
    $ingredientModel = new IngredientModel();
    $storeModelModel = new StoreModel();


    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }

      if ($storeModelModel->whereIn('id_ingredient', $ids)->countAllResults() > 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'Some ingredients are associated with a plate and cannot be deleted']);
      } else {

        if ($ingredientModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
          return $this->response->setJSON(['success' => true]);
        } else {
          return $this->response->setJSON(['success' => false, 'message' => 'Roles not found']);
        }
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  public function restoreIngredient()
  {
    $ingredientModel = new IngredientModel();

    try {

      $id = $this->request->getPost('id');

      if (empty($id)) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }



      if ($ingredientModel->update($id, ['disabled' => null])) {
        return $this->response->setJSON(['success' => true]);
      } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Ingredient not found']);
      }
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }



  public function exportIngredient()
  {
    $ingredientModel = new IngredientModel();
    $spreadsheet = new Spreadsheet();


    try {
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'NAME');
      $sheet->setCellValue('B1', 'AVAILABLE QUANTITY');
      $sheet->setCellValue('C1', 'EXPIRATION DATE');
      $sheet->setCellValue('D1', 'PRICE');
      $sheet->setCellValue('E1', 'ALLERGENS');


      $searchParams = $this->request->getGet('searchParams') ?? [];
      $searchParams['all'] = 'true';

      $sortBy = $this->request->getGet('sortBy') ?? 'name';

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';


      $data =  $ingredientModel->getIngredients(null, $searchParams, $sortBy, $sortDirection);


      $rowNumber = 2;

      foreach ($data as $row) {

        $allergens = json_decode($row['allergens'], true); 
        if (!is_array($allergens)) { 
          $allergens = ['none'];
        }

        $sheet->setCellValue('A' . $rowNumber, $row['name']);
        $sheet->setCellValue('B' . $rowNumber, $row['quantity_available'] . ' ' . $row['measure']);
        $sheet->setCellValue('C' . $rowNumber, date('d/m/Y', strtotime($row['expiration_date'])));
        $sheet->setCellValue('D' . $rowNumber, $row['price'] . ' $');
        $sheet->setCellValue('E' . $rowNumber, implode(', ', $allergens));

        
        if (!is_null($row['disabled'])) {
          $sheet->getStyle('A' . $rowNumber . ':E' . $rowNumber)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF6666');

          $sheet->getStyle('A' . $rowNumber . ':E' . $rowNumber)->getFont()
            ->getColor()->setARGB('FFFFFFFF');
        }

        $rowNumber++;
      }

      $writer = new Xlsx($spreadsheet);
      $filename = 'exportIngredient.xlsx';

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
