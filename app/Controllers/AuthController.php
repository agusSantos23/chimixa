<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolModel;

use Exception;

class AuthController extends BaseController
{

  public function loginForm()
  {
    $data['validation'] = session('validation');

    return view('pages/authentication/signIn', $data);
  }


  public function login()
  {
    $userModel = new UserModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]|max_length[255]',
    ]);

    try {
      if (!$validation->withRequest($this->request)->run()) {

        return redirect()->to(uri: base_url(relativePath: 'auth/login'))->with('validation', $validation->getErrors());
      } else {

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');


        $user = $userModel->getUserWithRoleByEmail($email);

        if ($user) {

          if (password_verify($password, $user->password)) {


            session()->set([
              'userId' => $user->id,
              'userName' => $user->name,
              'userLastName' => $user->last_name,
              'userEmail' => $user->email,
              'userRole' => $user->role_name,
              'userPhonePrefix' => $user->prefix,
              'userPhone' => $user->phone,
              'userCountry' => $user->country,
              'userImg' => $user->img,
              'is_logged_in' => true,
            ]);



            return redirect()->to('/');
          }
        }
        return redirect()->to(base_url('auth/login'))->with('validation', ['Incorrect credentials']);
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }


  public function registerForm()
  {
    $data['validation'] = session('validation');
    return view('pages/authentication/signUp', $data);
  }


  public function register()
  {
    $userModel = new UserModel();
    $roleModel = new RolModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]|max_length[255]',
      'lastName' => 'required|min_length[3]|max_length[255]',
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]|max_length[255]',
      'confirmPassword' => 'required|matches[password]',
      'prefix' => 'required',
      'phone' => 'required|numeric|min_length[7]|max_length[11]',
      'country' => 'required',
    ]);

    try {

      if (!$validation->withRequest($this->request)->run()) {

        return redirect()->to(uri: base_url('auth/register'))->with('validation', $validation->getErrors());
      } else {

        $userData = [
          'name' => $this->request->getPost('name'),
          'last_name' => $this->request->getPost('lastName'),
          'email' => $this->request->getPost('email'),
          'prefix' => $this->request->getPost('prefix'),
          'phone' => $this->request->getPost('phone'),
          'country' => $this->request->getPost('country'),
          'role_id' => $roleModel->getIdByName('Customer')
        ];

        $password = $this->request->getPost('password');
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);


        if ($userModel->where('email', $userData['email'])->first()) {
          return redirect()->to(base_url('auth/register'))->with('validation', ['This email is already registered']);
        }

        $userModel->save($userData);

        $user = $userModel->getUserWithRoleByEmail($userData['email']);

        session()->set([
          'userId' => $user->id,
          'userName' => $user->name,
          'userLastName' => $user->last_name,
          'userEmail' => $user->email,
          'userRole' => $user->role_name,
          'userPhonePrefix' => $user->prefix,
          'userPhone' => $user->phone,
          'userCountry' => $user->country,
          'userImg' => $user->img,
          'is_logged_in' => true,
        ]);


        
        return redirect()->to(uri: '/')->with('success', 'Usuario creado con éxito');
      }
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }
}
