<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\MenuPlateModel;
use App\Models\PlateModel;


use Exception;

class MenuPlateController extends BaseController
{

  public function index($menuId)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();
    $plateModel = new PlateModel();

    try {
      $menuRole = session()->get('userRole');

      if (!$menuRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper'); 

      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $sortBy = $this->request->getGet('sortBy') ?? 'name';
      $data['sortBy'] = $sortBy;

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';
      $data['sortDirection'] = $sortDirection;


      $data['menu'] = $menuModel->select('id, name')->find($menuId);
      $data['plates'] = $plateModel->select('id, name, price, category,disabled')->where('disabled', null)->findAll();

      $data = array_merge($data, $menuPlateModel->getPlatesByMenu($menuId, $perPage, $searchParams, $sortBy, $sortDirection));

      return view('pages/list/menu_plates_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function getPlatesInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();


    try {
      $menu = $menuModel->find($id);

      $menuPlates = $menuPlateModel->where('id_menu', $id)->findAll();



      $plates = array_map(function ($plate) {

        return ['id' => $plate['id_plate'], 'amount' => $plate['amount']];
      }, $menuPlates);



      if ($menu) {
        return $this->response->setStatusCode(200)->setJSON(['success' => true, 'menu' => $menu, 'plates' => $plates]);
      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'menu not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting menu: ' . $e->getMessage()]);
    }
  }


  public function savePlateInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'selectedPlates' => 'required',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
      } else {


        $selectedPlates =  json_decode($this->request->getPost('selectedPlates'), true);


        if (!$menuModel->find($id)) {
          return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Menu not found']]);
        }


        $currentPlates = $menuPlateModel->where('id_menu', $id)->findAll();

        $currentPlateIds = array_map(function ($plate) {
          return $plate['id_plate'];
        }, $currentPlates);

        $selectedPlateIds = array_map(function ($plate) {
          return $plate['id'];
        }, $selectedPlates);



        foreach ($selectedPlates as $plate) {

          if (in_array($plate['id'], $currentPlateIds)) {

            $menuPlateModel->set(['amount' => $plate['count']])
              ->where('id_menu', $id)
              ->where('id_plate', $plate['id'])
              ->update();

          } else {

            $menuPlateModel->save([
              'id_menu' => $id,
              'id_plate' => $plate['id'],
              'amount' => $plate['count']
            ]);
          }
        };

        foreach ($currentPlates as $currentPlate) {
          if (!in_array($currentPlate['id_plate'], $selectedPlateIds)) {
            $menuPlateModel->where('id_menu', $id)->where('id_plate', $currentPlate['id_plate'])->delete();
          }
        }

        return $this->response->setStatusCode(200)->setJSON(['success' => true]);
      }
    } catch (Exception $e) {

      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON([$selectedPlates, 'success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }




  public function deletePlatesInMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    try {

      if (!$menuModel->find($id)) {
        return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Menu not found']]);
      }

      $ids = $this->request->getPost('ids');

      

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }
      

      if (!$menuPlateModel->where('id_menu', $id)->whereIn('id_plate', $ids)->delete()) {

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete relation']);
      }

      
      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


}
