<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\MenuModel;
use App\Models\PlateModel;


use Exception;



class OrderController extends BaseController
{

  public function index()
  {
    $orderModel = new OrderModel();
    $menuModel = new MenuModel();
    $plateModel = new PlateModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));



      //$data['orders'] = $orderModel->getUserOrderDetails(session()->get('userId'));
      $data['menus'] = $menuModel->getMenusWithDetails();
      $data['plates'] = $plateModel->getPlatesWithDetails();





      return view('pages/list/order_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }



  public function saveOrder($id = null)
  {
    $orderModel = new OrderModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'selectedElements' => 'required'
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(code: 400)->setJSON(['errors' => $validation->getErrors()]);
      } else {
        $selectedElements = json_decode($this->request->getPost('selectedElements'), true);

        $userId = session()->get('userId');
        $codeGenerated = $this->generateOrderCode();

        if ($id) {
          /*
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

          */
        } else {


          foreach ($selectedElements as $element) {

            $orderData = [
              'id_user' => $userId,
              'id_element' => $element['id'],
              'code' => $codeGenerated,
              'type_element' => $element['type'],
              'amount' =>  $element['count'],
              'price' => $element['price']
            ];

            if (!$orderModel->save($orderData)) {
              return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add order']);
            }
          }

          return $this->response->setStatusCode(200)->setJSON(['message' => 'Order added successfully']);
        }
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }

  private function generateOrderCode(){
    $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2)); 
    $numbers = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    return $letters . '-' . $numbers;
  }
}
