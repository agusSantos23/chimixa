<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\MenuModel;
use App\Models\PlateModel;


use Exception;



class OrderController extends BaseController{

  public function index() {
    $orderModel = new OrderModel();
    $menuModel = new MenuModel();
    $plateModel = new PlateModel();
    

    try {

      $userRole = session()->get('userRole');
        
      if (!$userRole) return redirect()->to(base_url('/auth/login'));
      

      
      $data['orders'] = $orderModel->getUserOrderDetails(session()->get('userId'));
      $data['menus'] = $menuModel->getMenusWithDetails();
      $data['plates'] = $plateModel->where('disabled', null)->findAll();


    

      return view('pages/list/order_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  

}