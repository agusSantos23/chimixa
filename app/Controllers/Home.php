<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderElementModel;
use Exception;



class Home extends BaseController{

  public function index() {
    $orderModel = new OrderModel();
    $orderElementModel = new OrderElementModel();


    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      
      $perPage = 8;

      if ($userRole === 'Customer') {
        $data = $orderElementModel->getUserOrders(session()->get('userId'), $perPage);

      }else if ($userRole === 'Administrator') {

        $data['orders'] = null;
      }




      return view('dashboard', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
    
  }



  public function calendar() {
    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      
      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');


      return view('./pages/calendar', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function about(): string{
    return view('./pages/about');
  }

  


}