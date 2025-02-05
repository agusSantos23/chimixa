<?php

namespace App\Controllers;

use App\Models\OrderModel;
use Exception;



class OrderController extends BaseController{

  public function index() {
    $orderModel = new OrderModel();
    

    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      
      $data['orders'] = $orderModel->getUserOrderDetails(session()->get('userId'));


    

      return view('pages/list/order_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}