<?php

namespace App\Controllers;

use App\Models\UserModel;
use Exception;

class UserController extends BaseController{

  public function index() {
    $userModel = new UserModel();
    $data['users'] = $userModel->findAll();
    return view('user_form', $data);
  }



  public function saveUser($id = null){
    $userModel = new UserModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'role' => 'required|in_list[client,chef,admin]',
      'name' => 'required|min_length[3]|max_length[255]',
      'lastname' => 'required|min_length[3]|max_length[255]',
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]|max_length[255]',
      'confirm_password' => 'required|matches[password]',
      'phone' => 'required|numeric|max_length[20]',
      'country' => 'required|alpha_space|max_length[100]'
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        $data['validation'] = $validation;
        return view('user_form', $data);

      }else{

        $userData = [
          'role' => $this->request->getPost('role'),
          'name' => $this->request->getPost('name'),
          'lastname' => $this->request->getPost('lastname'),
          'email' => $this->request->getPost('email'),
          'phone' => $this->request->getPost('phone'),
          'country' => $this->request->getPost('country')
        ];
        
        $password = $this->request->getPost('password');
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);


        if ($id) {
          $userModel->update($id, $userData);
          $message = 'User successfully updated';

        } else {
          $userModel->save($userData);
          $message = 'User created successfully';
        }
        
        return redirect()->to(uri: '/users')->with('success', $message);
      }

      
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }

  public function deleteUser($id){
    $userModel = new UserModel();

    try {
      $userModel->delete($id);
      return redirect()->to('/users')->with('success', 'User successfully deleted');

    }  catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

  }

}