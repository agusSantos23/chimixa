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

      $perPage = $this->request->getGet('perPage') ?? 1;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $data = array_merge($data, $rolModel->getCountByRoles($perPage, $searchParams));


      return view('pages/list/rol_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


}