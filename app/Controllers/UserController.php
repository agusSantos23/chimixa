<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolModel;
use Exception;

class UserController extends BaseController
{


  public function index(){
    $userModel = new UserModel();
    $rolModel = new RolModel();


    try {

      $userRole = session()->get('userRole');

      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      
      $data['roles'] = $rolModel->whereNotIn('name', ['Administrador'])->findAll();



      $perPage = $this->request->getGet('perPage') ?? 1;
      $data['perPage'] = $perPage;

      $searchParams = $this->request->getGet('searchParams') ?? [];
      $data['searchParams'] = $searchParams;

      $data = array_merge($data, $userModel->getAllUsersWithRoles($perPage, $searchParams));



      return view('pages/list/user_list', $data);
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }




  public function saveUser($id = null){
    $userModel = new UserModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|alpha_space|min_length[3]|max_length[255]',
      'lastName' => 'required|alpha_space|min_length[3]|max_length[255]',
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]',
      'confirmPassword' => 'required|matches[password]',
      'prefix' => 'required|numeric|max_length[3]',
      'phone' => 'required|numeric|min_length[7]|max_length[11]',
      'country' => 'required|alpha_space|max_length[100]'
    ]);


    try {

      if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setStatusCode(400)->setJSON(['errors' => $validation->getErrors()]);

      } else {

        $userData = [
          'role_id' => $this->request->getPost('role'),
          'name' => $this->request->getPost('name'),
          'last_name' => $this->request->getPost('lastName'),
          'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
          'email' => $this->request->getPost('email'),
          'prefix' => $this->request->getPost('prefix'),
          'phone' => $this->request->getPost('phone'),
          'country' => $this->request->getPost('country'),
          'img' => $this->request->getPost('profileImg')
        ];



        if ($id) {
          /*
          $userModel->update($id, $userData);
          $message = 'User successfully updated';
          */
        } else {
          
          if ($userModel->save($userData)) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'User added successfully']);
          } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to add customer']);
          }
            
        }


      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }

  public function deleteUser($id)
  {
    $userModel = new UserModel();

    try {
      $userModel->delete($id);
      return redirect()->to('/users')->with('success', 'User successfully deleted');
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
