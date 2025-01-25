<?php

namespace App\Controllers;

use Exception;



class Home extends BaseController{

  public function index(): string{
    return view('dashboard');
  }

  public function about(): string{
    return view('./pages/about');
  }

  public function profile(): string{
    return view('./pages/overview');
  }


}