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


      return view('dashboard', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
    
  }

  public function calendar() {
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
      
      $data['aside'] = view('templates/aside', $data);
      $data['footer'] = view('templates/footer');


      return view('./pages/calendar', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

  }


  public function about(): string{
    return view('./pages/about');
  }

  public function profile(): string{
    return view('./pages/overview');
  }



}