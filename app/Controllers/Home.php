<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderElementModel;
use Exception;



class Home extends BaseController
{

  public function index()
  {
    $orderElementModel = new OrderElementModel();

    try {
      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      $perPage = 6;

      if ($userRole === 'Customer') {

        $orderUser = $orderElementModel->getUserOrders(session()->get('userId'), $perPage);
        $orderElements = $orderElementModel->select('id, type_element, price, amount, created_at')->where('id_user', session()->get('userId'))->findAll();

        $data['orderUser'] = $orderUser['orders'];


      } else if ($userRole === 'Administrator') {

        $orderElements = $orderElementModel->select('id, type_element, price, amount, created_at')->findAll();

        $data['orders'] = null;

      }

      $data['orderElements'] = $orderElements;


      return view('dashboard', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }




  public function calendar()
  {
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

  public function about(): string
  {
    return view('./pages/about');
  }
}
