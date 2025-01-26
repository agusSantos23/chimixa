<?php

namespace App\Controllers;

use App\Models\MenuModel;
use Exception;



class MenuController extends BaseController{

  public function index() {
    $menuModel = new MenuModel();

    try {
      
      $menus = $menuModel->getAllMenusWithPlates();
      
      $groupedMenus = [];

      foreach ($menus as $menu) {

        if (!isset($groupedMenus[$menu->menu_id])) {
          $groupedMenus[$menu->menu_id] = [
            'menu_id' => $menu->menu_id,
            'menu_name' => $menu->menu_name,
            'menu_description' => $menu->menu_description,
            'menu_price' => $menu->menu_price,
            'plates' => [] 
          ];
        }

        $groupedMenus[$menu->menu_id]['plates'][] = [
          'plate_id' => $menu->plate_id,
          'plate_name' => $menu->plate_name,
          'plate_price' => $menu->plate_price,
          'plate_category' => $menu->plate_category,
          'plate_amount' => $menu->plate_amount
        ];
      }

      $data['menus'] = $groupedMenus;
      return view('pages/list/menu_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
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

      }else{

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

    }  catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

  }


}