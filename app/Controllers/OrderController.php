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
      

      $data['dataUser'] = [
        'userId' => session()->get('userId'),
        'userName' => session()->get('userName'),
        'userLastname' => session()->get('userLastname'),
        'userEmail' => session()->get('userEmail'),
        'userPhone' => session()->get('userPhone'),
        'userCountry' => session()->get('userCountry'),
        'userRole' => $userRole
      ];
      
      $data['orders'] = $orderModel->getUserOrderDetails($data['dataUser']['userId']);



      $data['aside'] = view('templates/aside', $data);
      $data['footer'] = view('templates/footer');

    

      return view('pages/list/order_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}