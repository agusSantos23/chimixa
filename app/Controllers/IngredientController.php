<?php

namespace App\Controllers;

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




      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;



      $data = array_merge($data, $ingredientModel->getIngredients($perPage, $searchParams));


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
        if (!empty($ingredient['expiration_date'])) {
          $ingredient['expiration_date'] = date('d/m/Y', strtotime($ingredient['expiration_date']));
        }

        return $this->response->setStatusCode(200)->setJSON(['success' => $ingredient]);
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
        return $this->response->setJSON(['success' => false,'message' => 'Some ingredients are associated with a plate and cannot be deleted']);

      }else {
        
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
}
