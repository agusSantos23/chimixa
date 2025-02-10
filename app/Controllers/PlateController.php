<?php

namespace App\Controllers;

use App\Models\PlateModel;
use App\Models\StoreModel;
use App\Models\IngredientModel;

use Exception;


class PlateController extends BaseController{

  public function index(){
    $plateModel = new PlateModel();
    $ingredientModel = new IngredientModel();


    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      
      $data['ingredients'] = $ingredientModel->where('disabled', null)->findAll();


      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $data = array_merge($data, $plateModel->getPlates($perPage, $searchParams));


      return view('pages/list/plate_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  
  public function savePlate($id = null){
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

      }else{

        $plateData = [
          'name' => ucfirst($this->request->getPost('name')),
          'description' => ucfirst($this->request->getPost('description')),
          'price' => $this->request->getPost('price'),
          'category' => $this->request->getPost('category'),
          'preparation_time' => $this->request->getPost('preparationTime'),
          'selectedIngredients' => json_decode($this->request->getPost('selectedIngredients'), true)
        ];
        

        if ($id) {
          $plateModel->update($id, $plateData);
          $message = 'Plate successfully updated';

        } else {

          if ($plateModel->where('name', $plateData['name'])->first()) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['This name is already registered']]);
          }


          if ($plateModel->save($plateData)) {

            $plateId = $plateModel->where('name', $plateData['name'])->first()['id'];

            $correct = true;

            foreach ($plateData['selectedIngredients'] as $ingredient) {

              if (!$storeModel->save(['id_plate' => $plateId, 'id_ingredient' => $ingredient['id'], 'amount' => $ingredient['quantity']])) {
                $correct = false;
              }

            };

            if ($correct) {

              return $this->response->setStatusCode(200)->setJSON(['message' => 'Plate added successfully']);

            } else {

              $plateModel->delete($plateId);
              return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
            }

          } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add plate']);
          }


        }
        
        return redirect()->to(uri: '/plates')->with('success', $message);
      }

      
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function deletePlate(){
    $plateModel = new PlateModel();
    $storeModel = new StoreModel();


    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }

      log_message('info', 'Updating plates with IDs: ' . implode(', ', $ids));



      if (!$plateModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Plates not found']);
      }

      if (!$storeModel->whereIn('id_plate', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to archive ingredients of menu']);
      }

      return $this->response->setJSON(['success' => true]);

    }  catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

  }


  public function ingredientsOfPlate($plateId){

    $plateModel = new PlateModel();
    $storeModel = new StoreModel();

    try {
      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      


      $data['plate'] = $plateModel->select('id, name')->find($plateId);
      $data['ingredients'] = $storeModel->getIngredientsByPlate($plateId);

      return view('pages/list/store_list',$data );
      

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}