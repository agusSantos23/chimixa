<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderElementModel;
use Exception;



class Home extends BaseController
{

  public function index()
  {
    $orderModel = new OrderModel();
    $orderElementModel = new OrderElementModel();

    try {
      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));


      if ($userRole === 'Customer') {

        $orderUser = $orderElementModel->getUserOrders(session()->get('userId'), null);
        $orderElements = $orderElementModel->select('id, type_element, price, amount, created_at')->where('id_user', session()->get('userId'))->findAll();

        $data['orderUser'] = $orderUser['orders'];


      } else if ($userRole === 'Administrator' || $userRole === 'Chef') {

        $allOrders = $orderModel->findAll();
        $orderElements = $orderElementModel->select('id, type_element, price, amount, created_at')->findAll();

        $data['orderUser'] = $allOrders;

      }

      $data['orderElements'] = $orderElements;


      return view('dashboard', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }





  public function about(): string
  {
    return view('./pages/about');
  }
}
