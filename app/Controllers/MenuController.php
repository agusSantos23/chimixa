<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\MenuPlateModel;
use App\Models\PlateModel;


use Exception;



class MenuController extends BaseController
{
  public function index()
  {
    $menuModel = new MenuModel();
    $plateModel = new PlateModel();

    try {

      $menuRole = session()->get('userRole');
      if (!$menuRole) return redirect()->to(base_url('/auth/login'));

      helper('sort_helper');


      $data['plates'] = $plateModel->where('disabled', null)->findAll();

      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $sortBy = $this->request->getGet('sortBy') ?? 'name';
      $data['sortBy'] = $sortBy;

      $sortDirection = $this->request->getGet('sortDirection') ?? 'asc';
      $data['sortDirection'] = $sortDirection;

      $data = array_merge($data, $menuModel->getMenus($perPage, $searchParams, $sortBy, $sortDirection));


      return view('pages/list/menu_list', $data);
    } catch (Exception $e) {
      return "Error: " . $e->getMessage();
    }
  }


  public function getMenu($id)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();


    try {
      $menuData = $menuModel->find($id);




      $menuPlates = $menuPlateModel->where('id_menu', $id)->findAll();

      $plates = array_map(function ($plate) {
        return ['id' => $plate['id_plate'], 'amount' => $plate['amount']];
      }, $menuPlates);



      if ($menuData) {

        if ($menuData['disabled'] !== null) {
          return $this->response->setStatusCode(400)->setJSON(['errors' => 'This menu is not editable because it is disabled.']);
        } else {
          return $this->response->setStatusCode(200)->setJSON(['success' => true, 'menu' => $menuData, 'plates' => $plates]);
        }
      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'menu not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting menu: ' . $e->getMessage()]);
    }
  }



  public function saveMenu($id = null)
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'description' => 'min_length[10]|max_length[500]',
      'price' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[99999999.99]',
      'selectedPlates' => 'required',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(code: 400)->setJSON(['errors' => $validation->getErrors()]);
      } else {

        $menuData = [
          'name' => ucfirst($this->request->getPost('name')),
          'description' => ucfirst($this->request->getPost('description')),
          'price' => $this->request->getPost('price'),
          'selectedPlates' => json_decode($this->request->getPost('selectedPlates'), true)
        ];


        if ($id !== null) {

          if (!$menuModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'Menu not found']]);
          }

          if ($menuModel->update($id, $menuData)) {

            $currentPlates = $menuPlateModel->where('id_menu', $id)->findAll();

            $currentPlateIds = array_map(function ($plate) {
              return $plate['id_plate'];
            }, $currentPlates);

            $selectedPlateIds = array_map(function ($plate) {
              return $plate['id'];
            }, $menuData['selectedPlates']);



            foreach ($menuData['selectedPlates'] as $plate) {

              if (in_array($plate['id'], $currentPlateIds)) {

                $menuPlateModel->set(['amount' => $plate['count']])->where('id_menu', $id)->where('id_plate', $plate['id'])->update();
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
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['error' => 'Failed to updated Menu']]);
          }
        } else {

          if ($menuModel->where('name', $menuData['name'])->first()) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['This name is already registered']]);
          }


          if ($menuModel->save($menuData)) {

            $menuId = $menuModel->where('name', $menuData['name'])->first()['id'];

            $correct = true;

            foreach ($menuData['selectedPlates'] as $plate) {

              if (!$menuPlateModel->save(['id_menu' => $menuId, 'id_plate' => $plate['id'], 'amount' => $plate['count']])) {
                $correct = false;
              }
            };

            if ($correct) {
              return $this->response->setStatusCode(200)->setJSON(['message' => 'Menu added successfully']);
            } else {
              $menuModel->delete($menuId);
              return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
            }
          } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
          }
        }
      }
    } catch (Exception $e) {

      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON([$menuData, 'success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


  public function deleteMenu()
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    try {

      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }



      if (!$menuModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Menus not found']);
      }

      if (!$menuPlateModel->whereIn('id_menu', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to archive plates of menu']);
      }

      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


  public function restoreMenu()
  {
    $menuModel = new MenuModel();
    $menuPlateModel = new MenuPlateModel();

    try {

      $id = $this->request->getPost('id');

      if (empty($id)) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }



      if (!$menuModel->update($id, ['disabled' => null])) {
        return $this->response->setJSON(['success' => false, 'message' => 'Menus not found']);
      }

      if (!$menuPlateModel->where('id_menu', $id)->update(null, ['disabled' => null])) {
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to archive plates of menu']);
      }

      return $this->response->setJSON(['success' => true]);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }
}
