<?php

namespace App\Controllers;

use App\Models\PlateModel;
use App\Models\StoreModel;
use App\Models\IngredientModel;
use App\Models\MenuPlateModel;


use Exception;


class PlateController extends BaseController
{

  public function index()
  {
    $plateModel = new PlateModel();
    $ingredientModel = new IngredientModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper'); 


      $data['ingredients'] = $ingredientModel->where('disabled', null)->findAll();

      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $sortBy = $this->request->getGet('sortBy') ?? 'name';
      $data['sortBy'] = $sortBy;

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';
      $data['sortDirection'] = $sortDirection;

      $data = array_merge($data, $plateModel->getPlates($perPage, $searchParams, $sortBy, $sortDirection));

      return view('pages/list/plate_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }



  public function getPlate($id)
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();


    try {
      $plate = $plateModel->find($id);

      $stores = $storeModel->select('id_ingredient')->where('id_plate', $id)->findAll();




      if ($plate) {

        if ($plate['disabled'] !== null) {
          return $this->response->setStatusCode(400)->setJSON(['errors' => 'This plate is not editable because it is disabled.']);
        } else {
          return $this->response->setStatusCode(200)->setJSON(['success' => true, 'plate' => $plate, 'ingredientsSelect' => $stores]);

        }

      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'plate not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting plate: ' . $e->getMessage()]);
    }
  }



  public function savePlate($id = null)
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();


    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'description' => 'min_length[10]|max_length[500]',
      'price' => 'required|decimal|greater_than_equal_to[0]',
      'category' => 'required|in_list[Breakfast, Lunch, Dinner]',
      'preparationTime' => 'required|integer|greater_than[0]',
      'selectedIngredients' => 'required'
    ]);


    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(code: 400)->setJSON(['errors' => $validation->getErrors()]);
      } else {

        $plateData = [
          'name' => ucfirst($this->request->getPost('name')),
          'description' => ucfirst($this->request->getPost('description')),
          'price' => $this->request->getPost('price'),
          'category' => $this->request->getPost('category'),
          'preparation_time' => $this->request->getPost('preparationTime'),
          'selectedIngredients' => json_decode($this->request->getPost('selectedIngredients'), true)
        ];


        if ($id) {

          if (!$plateModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Plate not found']]);
          }


          if ($plateModel->update($id, $plateData)) {

            $currentIngredients = $storeModel->select('id_ingredient')->where('id_plate', $id)->findAll();


            $currentIngredientIds = array_column($currentIngredients, 'id_ingredient');


            foreach ($plateData['selectedIngredients'] as $ingredientId) {


              if (!in_array($ingredientId, $currentIngredientIds)) {

                $storeModel->save([
                  'id_plate' => $id,
                  'id_ingredient' => $ingredientId
                ]);
              }
            };

            foreach ($currentIngredientIds as $ingredientId) {

              if (!in_array($ingredientId, $plateData['selectedIngredients'])) {

                $storeModel->where('id_plate', $id)->where('id_ingredient', $ingredientId)->delete();
              }
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true]);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['user' => 'Failed to updated Plate']]);
          }
        } else {

          if ($plateModel->where('name', $plateData['name'])->first()) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['This name is already registered']]);
          }


          if ($plateModel->save($plateData)) {

            $plateId = $plateModel->where('name', $plateData['name'])->first()['id'];

            $correct = true;

            foreach ($plateData['selectedIngredients'] as $ingredient) {

              if (!$storeModel->save(['id_plate' => $plateId, 'id_ingredient' => $ingredient])) {
                $correct = false;
              }
            };

            if ($correct) {

              return $this->response->setStatusCode(200)->setJSON(['message' => 'Plate added successfully']);
            } else {

              return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
            }
          } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add plate']);
          }
        }
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function deletePlate()
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();
    $menuPlateModel = new MenuPlateModel();


    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }

      if ($menuPlateModel->whereIn('id_plate', $ids)->countAllResults() > 0) {

        return $this->response->setJSON(['success' => false,'message' => 'Some plates are associated with a menu and cannot be deleted']);

      } else {

        if (!$plateModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
          return $this->response->setJSON(['success' => false, 'message' => 'Plates not found']);
        }

        if (!$storeModel->whereIn('id_plate', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
          return $this->response->setJSON(['success' => false, 'message' => 'Failed to archive ingredients of menu']);
        }
      }




      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  
  public function restorePlate()
  {
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();

    try {

      $id = $this->request->getPost('id');

      if (empty($id)) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }



      if (!$plateModel->update($id, ['disabled' => null])) {
        return $this->response->setJSON(['success' => false, 'message' => 'Menus not found']);
      }

      if (!$storeModel->where('id_plate', $id)->update(null, ['disabled' => null])) {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to archive plates of menu']);
      }

      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }
}
