<?php

namespace App\Controllers;

use Exception;



class Home extends BaseController{

  public function index(): string{

    $data['aside'] = view('templates/aside');
    $data['footer'] = view('templates/footer');


    return view('dashboard', $data);
  }

  public function about(): string{
    return view('./pages/about');
  }

  public function profile(): string{
    return view('./pages/overview');
  }


}