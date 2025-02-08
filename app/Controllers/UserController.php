<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolModel;
use Exception;

class UserController extends BaseController
{


  public function index()
  {
    $userModel = new UserModel();
    $rolModel = new RolModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));


      $data['roles'] = $rolModel->getActiveRolesExcludingAdmin();



      $perPage = $this->request->getGet('perPage') ?? 5;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $data = array_merge($data, $userModel->getAllUsersWithRoles($perPage, $searchParams));


      return view('pages/list/user_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function getUser($id)
  {
    $userModel = new UserModel();


    try {
      $user = $userModel->getUserWithRoleById($id);

      if ($user) {
        return $this->response->setStatusCode(200)->setJSON(['success' => $user]);
      } else {

        return $this->response->setStatusCode(400)->setJSON(['errors' => 'User not found']);
      }
    } catch (Exception $e) {

      return $this->response->setStatusCode(500)->setJSON(['error' => 'Error getting user: ' . $e->getMessage()]);
    }
  }



  public function saveUser($id = null)
  {
    $userModel = new UserModel();

    $validation = \Config\Services::validation();
    $rules = [
      'name' => 'required|alpha_space|min_length[3]|max_length[255]',
      'lastName' => 'required|alpha_space|min_length[3]|max_length[255]',
      'email' => 'required|valid_email',
      'prefix' => 'required|numeric|max_length[3]',
      'phone' => 'required|numeric|min_length[7]|max_length[11]',
      'country' => 'required|alpha_space|max_length[100]',
      'img' => 'permit_empty|string',
    ];

    if ($id === null) {
      $rules['password'] = 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]';
      $rules['confirmPassword'] = 'required|matches[password]';
    }else{
      $rules['password'] = 'permit_empty|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]';
      $rules['confirmPassword'] = 'permit_empty|matches[password]';
    }

    $validation->setRules($rules);


    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);

      } else {

        $userData = [
          'role_id' => $this->request->getPost('role'),
          'name' => ucfirst($this->request->getPost('name')),
          'last_name' => ucfirst($this->request->getPost('lastName')),
          'email' => $this->request->getPost('email'),
          'prefix' => $this->request->getPost('prefix'),
          'phone' => $this->request->getPost('phone'),
          'country' => $this->request->getPost('country'),
          'img' => $this->request->getPost('profileImg')
        ];




        if ($id !== null) {

          if (!$userModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['errors' => ['id' => 'User not found']]);
          }

          $newPassword = $this->request->getPost('password');
          
          if (!empty($newPassword)) {
            $userData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
          }


          if ($userModel->update($id, $userData)) {
            return $this->response->setStatusCode(200)->setJSON(['success' => true]);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['errors' => ['user' => 'Failed to updated User']]);
          }

        } else {


          if ($userModel->where('email', $userData['email'])->first()) {
            return $this->response->setStatusCode(400)->setJSON(['errors' => ['This email is already registered']]);
          }

          $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT); 




          if ($userModel->save($userData)) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'User added successfully']);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
          }
        }
      }
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }


  public function deleteUser()
  {
    $userModel = new UserModel();

    try {
      $ids = $this->request->getPost('ids');

      if (count($ids) === 0) {
        return $this->response->setJSON(['success' => false, 'message' => 'No IDs provided']);
      }


      if ($userModel->whereIn('id', $ids)->set(['disabled' => date('Y-m-d H:i:s')])->update()) {
        return $this->response->setJSON(['success' => true]);
      } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Users not found']);
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }
}
