<?php

namespace App\Controllers;

use App\Models\RolModel;
use Exception;


class RolController extends BaseController{

  public function index(){
    $rolModel = new RolModel();

    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      
      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');

      $data['roles'] = $rolModel->getCountByRoles();



      return view('pages/list/rol_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


}