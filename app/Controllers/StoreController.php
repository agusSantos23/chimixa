<?php

namespace App\Controllers;

use App\Models\PlateModel;
use App\Models\StoreModel;
use App\Models\IngredientModel;

use Exception;


class StoreController extends BaseController
{

  public function index($plateId)
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


      $data['plate'] = $plateModel->select('id, name')->find($plateId);
      $data['ingredients'] = $ingredientModel->select('id, name')->where('disabled', null)->findAll();


      $data = array_merge($data, $storeModel->getIngredientsByPlate($plateId, $perPage, $searchParams, $sortBy, $sortDirection));

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

        log_message('info',  print_r($selectedIngredients,true));

        if (!$plateModel->find($id)) {
          return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Plate not found']]);
        }


        $currentIngredients = $storeModel->select('id_ingredient')->where('id_plate', $id)->findAll();


        $currentIngredientIds = array_column($currentIngredients, 'id_ingredient');


        foreach ($selectedIngredients as $ingredientId) {
          log_message('info', $ingredientId . "arrrrrrrayaayayayaay:       ". print_r($currentIngredientIds,true));


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
      log_message("info", $id);

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



}