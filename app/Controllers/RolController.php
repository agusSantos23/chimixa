<?php

namespace App\Controllers;

use App\Models\RolModel;
use Exception;


class RolController extends BaseController{

  public function index(){
    $rolModel = new RolModel();

    try {

      $data['roles'] = $rolModel->getCountByRoles();
      
      $data['aside'] = view('templates/aside');
      $data['footer'] = view('templates/footer');


      return view('pages/list/rol_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


}