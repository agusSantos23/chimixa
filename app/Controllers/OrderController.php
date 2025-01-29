<?php

namespace App\Controllers;

use App\Models\OrderModel;
use Exception;



class OrderController extends BaseController{

  public function index() {
    $session = session();
    $userId = $session->get('userId');
    $orderModel = new OrderModel();
    

    try {
      
      $data['orders'] = $orderModel->getUserOrderDetails($userId);



      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');

    

      return view('pages/list/order_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}