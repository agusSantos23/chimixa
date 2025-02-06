<?php

namespace App\Controllers;

use App\Models\RolModel;
use Exception;


class RolController extends BaseController
{

  public function index()
  {
    $rolModel = new RolModel();

    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));



      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;


      $data = array_merge($data, $rolModel->getCountByRoles($perPage, $searchParams));


      return view('pages/list/rol_list', $data);

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }


  public function saveRol($id = null)
  {
    $rolModel = new RolModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|alpha_space|min_length[3]|max_length[255]',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);
      } else {

        $rolData = [
          'name' => ucfirst($this->request->getPost('name'))
        ];


        if ($id) {
          /*
          $rolModel->update($id, $rolName);
          $message = 'Rol successfully updated';
          */
        } else {

          if ($rolModel->save($rolData)) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Rol added successfully']);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
          }
        }
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }

  public function deleteRol()
  {
    $rolModel = new RolModel();

    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }


      if ($rolModel->deactivateIds($ids, date('Y-m-d H:i:s'))) {
        return $this->response->setJSON(['success' => true]);
      } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Roles not found']);
      }

    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }
}
