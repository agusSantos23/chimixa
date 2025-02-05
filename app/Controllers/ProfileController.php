<?php

namespace App\Controllers;


use Exception;

class ProfileController extends BaseController{


  public function profile(){
    

    try {
      $userRole = session()->get('userRole');


      if (!$userRole) return redirect()->to(base_url('/auth/login'));


      
      return view('./pages/overview');

    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }

  }

  public function logout(){
    

    try {

      session()->destroy();
      return redirect()->to(base_url('/auth/login'));
      

    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }

  }
}