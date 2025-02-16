<?php

namespace App\Controllers;

use App\Models\OrderModel;
use Exception;



class Home extends BaseController{

  public function index() {
    $orderModel = new OrderModel();


    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      //$data['orders'] = $orderModel->getUserOrderDetails(session()->get('userId'));

      
      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');


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