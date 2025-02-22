<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderElementModel;
use App\Models\MenuModel;
use App\Models\PlateModel;


use Exception;



class OrderController extends BaseController
{

  public function index()
  {
    $orderModel = new OrderModel();
    $orderElementModel = new OrderElementModel();
    $menuModel = new MenuModel();
    $plateModel = new PlateModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper'); 

      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $sortBy = $this->request->getGet('sortBy') ?? 'id';
      $data['sortBy'] = $sortBy;

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';
      $data['sortDirection'] = $sortDirection;

      $data['menus'] = $menuModel->getMenusWithDetails();
      $data['plates'] = $plateModel->getPlatesWithDetails();


      if ($userRole === 'Customer') {
        $data = array_merge($data, $orderElementModel->getUserOrders(session()->get('userId'), $perPage, $searchParams));
      }elseif ($userRole === 'Administrator'){
        $data = array_merge($data, $orderModel->getAllOrders($perPage, $searchParams, $sortBy, $sortDirection));
      }



      return view('pages/list/order_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }



  public function getOrder($id)
  {
    $orderElementModel = new OrderElementModel();



    try {

      $order = $orderElementModel->where('id_order', $id)->findAll();


      if ($order) {

        return $this->response->setStatusCode(200)->setJSON(['success' => true, 'data' => $order]);
      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'order not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting order: ' . $e->getMessage()]);
    }
  }




  public function saveOrder()
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

        $orderData = [
          'price' => array_sum(array_map(function ($element) {
            return $element['price'] * $element['count'];
          }, $selectedElements))
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


  public function deleteOrder()
  {
    $orderModel = new OrderModel();


    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }



      if (!$orderModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Code not found']);
      } else {
        return $this->response->setJSON(['success' => true]);
      }
    } catch (Exception $e) {
      return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }
}
