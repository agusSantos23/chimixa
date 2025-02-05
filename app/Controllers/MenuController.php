<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\MenuPlateModel;

use Exception;



class MenuController extends BaseController {
  public function index() {
    $menuModel = new MenuModel();

    try {
      
      $userRole = session()->get('userRole');
      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      

      $perPage = $this->request->getGet('perPage') ?? 1;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;


      $data = array_merge($data, $menuModel->getMenus($perPage, $searchParams));
     

      return view('pages/list/menu_list', $data);

    } catch (Exception $e) {
      return "Error: " . $e->getMessage();
    }
  }




  public function saveMenu($id = null){
    $menuModel = new MenuModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'description' => 'min_length[10]|max_length[500]',
      'price' => 'required|decimal|greater_than_equal_to[0]',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        $data['validation'] = $validation;
        return view('menu_form', $data);
      } else {

        $menuData = [
          'name' => $this->request->getPost('name'),
          'description' => $this->request->getPost('description'),
          'price' => $this->request->getPost('price'),
        ];


        if ($id) {
          $menuModel->update($id, $menuData);
          $message = 'Menu successfully updated';
        } else {
          $menuModel->save($menuData);
          $message = 'Menu created successfully';
        }

        return redirect()->to(uri: '/menus')->with('success', $message);
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function deleteMenu($id){
    $menuModel = new MenuModel();

    try {
      $menuModel->delete($id);
      return redirect()->to('/menus')->with('success', 'Menu successfully deleted');
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  public function platesOfMenu($menuId){
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));



      $data['menu'] = $menuModel->select('id, name')->find($menuId);
      $platesOfMenu = $menuPlateModel->getPlatesByMenu($menuId);

      $data['plates'] = !empty($platesOfMenu) ? $platesOfMenu : [];

      return view('pages/list/menu_plates_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
