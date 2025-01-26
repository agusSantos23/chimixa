<?php


namespace App\Controllers;

use App\Models\MenuPlateModel;
use Exception;

class MenuPlateController extends BaseController{

  public function index() {
    $menuPlateModel = new MenuPlateModel();

    try {
      
      $data['$menusPlates'] = $menuPlateModel->findAll();
      return view('menuPlate_form', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}