<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderElementModel;
use App\Models\MenuModel;
use App\Models\PlateModel;
use Exception;

class EventOrderController extends BaseController
{
  public function index()
  {
    $menuModel = new MenuModel();
    $plateModel = new PlateModel();
    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      $data['menus'] = $menuModel->getMenusWithDetails();
      $data['plates'] = $plateModel->getPlatesWithDetails();


      return view('./pages/calendar', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function ajaxEvents()
  {
    $orderModel = new OrderModel();
    $orderElementModel = new OrderElementModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper');


      if ($userRole === 'Customer') {
        $data = $orderElementModel->getUserOrders(session()->get('userId'), 5, ['all' => 'true']);
      } elseif ($userRole === 'Administrator') {

        $data = ['orders' => $orderModel->select('id, price, date')->findAll()];
      }



      return $this->response->setStatusCode(200)->setJSON(['data' => $data]);
    } catch (Exception $e) {

      return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }

  public function saveEvent($date)
  {

    $orderModel = new OrderModel();
    $orderElementModel = new OrderElementModel();


    $validation = \Config\Services::validation();
    $validation->setRules([
      'selectedElements' => 'required'
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(code: 400)->setJSON(['errors' => $validation->getErrors()]);
      } else {

        $selectedElements = json_decode($this->request->getPost('selectedElements'), true);

        log_message("info", $date);


        $orderData = [
          'price' => array_sum(array_map(function ($element) {
            return $element['price'] * $element['count'];
          }, $selectedElements)),
          'date' => $date
        ];



        if (!$orderModel->save($orderData)) {

          return $this->response->setStatusCode(500)->setJSON(['messageorder' => $orderModel->errors()]);
        }

        $userId = session()->get('userId');
        $orderId = $orderModel->select('id')->orderBy('created_at', 'DESC')->first();


        foreach ($selectedElements as $element) {
          $orderElementData = [
            'id_order' => $orderId,
            'id_user' => $userId,
            'id_element' => $element['id'],
            'type_element' => $element['type'],
            'amount' =>  $element['count'],
            'price' => $element['price']
          ];

          if (!$orderElementModel->save($orderElementData)) {
            return $this->response->setStatusCode(code: 500)->setJSON(body: ['messageorderelements' => $orderElementModel->errors()]);
          }
        }

        return $this->response->setStatusCode(200)->setJSON([
          'message' => 'Order added successfully',
        ]);
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }

  public function deleteEvent($id) {

    $orderModel = new OrderModel();


    try {

      if (empty($id)) {
        return $this->response->setJSON(['success' => false, 'message' => 'No Code provided']);
      }


      if (!$orderModel->where('id', $id)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Code not found']);
      } else {
        return $this->response->setJSON(['success' => true]);
      }
      
    } catch (Exception $e) {
      return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }
}
