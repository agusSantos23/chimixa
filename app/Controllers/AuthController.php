<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolModel;

use Exception;

class AuthController extends BaseController{

  public function loginForm() {
    return view('pages/authentication/signIn');
  }

  
  public function login(){
    $userModel = new UserModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]|max_length[255]',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        $data['validation'] = $validation;
        return view('pages/authentication/signIn', $data);

      }else{
      
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');


        $user = $userModel->where('email', $email)->first();

        if ($user) {

          if (password_verify($password, $user['password'])) {

            session()->set([
              'user_id' => $user['id'],
              'user_name' => $user['name'],
              'user_lastname' => $user['lastname'],
              'user_email' => $user['email'],
              'user_phone' => $user['phone'],
              'user_country' => $user['country'],
              'is_logged_in' => true,
            ]);


            return redirect()->to('/'); 
          }
            
        }

        return redirect()->back()->with('error', 'Credenciales incorrectos');

      }

    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }

    
  }


  public function registerForm() {
    $rolModel = new RolModel();
    $data['roles'] = $rolModel->findAll();
    $data['validation'] = session('validation'); 
    return view('pages/authentication/signUp', $data);
  }


  public function register(){
    $userModel = new UserModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'lastName' => 'required|min_length[3]|max_length[255]',
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]|max_length[255]',
      'confirmPassword' => 'required|matches[password]',
      'role' => 'required',
      'prefix' => 'required',
      'phone' => 'required|numeric|min_length[7]|max_length[11]',
      'country' => 'required',
      
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return redirect()->to( base_url('auth/register'))->with('validation', $validation);

      }else{
      
        $userData = [
          'name' => $this->request->getPost('name'),
          'lastname' => $this->request->getPost('lastName'),
          'email' => $this->request->getPost('email'),
          'role' => $this->request->getPost('role'),
          'prefix' => $this->request->getPost('prefix'),
          'phone' => $this->request->getPost('phone'),
          'country' => $this->request->getPost('country'),
        ];

        $password = $this->request->getPost('password');
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);

        $userModel->save($userData);

        return redirect()->to(uri: '/')->with('success', 'Usuario creado con éxito');

      }

    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }

    
  }

}