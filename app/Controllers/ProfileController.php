<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\OrderElementModel;

use Exception;

class ProfileController extends BaseController
{


  public function index()
  {

    $userModel = new UserModel();
    $orderElementModel = new OrderElementModel();

    try {
      $userRole = session()->get('userRole');


      if (!$userRole) return redirect()->to(base_url('/auth/login'));

      $data['totalAmount'] = 0;
      $data['totalPrice'] = 0.0;

      if ($this->request->getGet('isEditing') === 'true') {
        $data['userData'] = $userModel->getUserWithRoleById(session()->get('userId'));
      }

      if ($userRole === 'Customer') {

        $ordersUsers = $orderElementModel->getUserOrders(session()->get('userId'), null, ['all' => true]);
        $orderElements = $ordersUsers['orders'];
      } else if ($userRole === 'Administrator' || $userRole === 'Chef') {

        $orderElements = $orderElementModel->select('id, type_element, price, amount, created_at')->findAll();
      }


      foreach ($orderElements as $order) {
        $data['totalAmount'] += $order['amount'];
        $data['totalPrice'] += $order['price'] * $order['amount'];
      }





      return view('./pages/overview', $data);
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }

  public function saveProfile($id)
  {
    $userModel = new UserModel();

    try {

      $user = $userModel->find($id);

      if (!$user) {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'New password fields cannot be empty']);
      }

      $data = $this->request->getPost();
      $updateData = [];

      $allowedFields = ['fname', 'lname', 'email', 'prefix', 'phone', 'country', 'profileImg'];

      foreach ($data as $key => $value) {
        if (in_array($key, $allowedFields) && !empty($value)) {
          $updateData[$key] = $value;
        }
      }


      if (!empty($data['passwordOld'])) {

        if (empty($data['password']) || empty($data['confirmPassword'])) {
          return $this->response->setStatusCode(400)->setJSON(['message' => 'New password fields cannot be empty']);
        } else if ($data['password'] === $data['passwordOld']) {
          return $this->response->setStatusCode(400)->setJSON(['message' => 'New password cannot be the same as the old password']);
        } else if (!password_verify($data['passwordOld'], $user['password'])) {
          return $this->response->setStatusCode(400)->setJSON(['message' => 'The current password is incorrect']);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
          'password' => 'required|min_length[8]|max_length[255]',
          'confirmPassword' => 'required|matches[password]',
        ]);

        if (!$validation->run($data)) {
          return $this->response->setStatusCode(400)->setJSON(['message' => $validation->getErrors()]);
        }



        $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      }



      if ($userModel->update($id, $updateData)) {

        session()->set([
          'userName' => $updateData['fname'],
          'userLastName' => $updateData['lname'],
          'userEmail' => $updateData['email'],
          'userPhonePrefix' => $updateData['prefix'],
          'userPhone' => $updateData['phone'],
          'userCountry' => $updateData['country'],
          'userImg' => $updateData['profileImg'],
          'is_logged_in' => true,
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Profile updated successfully']);
      } else {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Error trying to update profile']);
      }
    } catch (Exception $e) {
      return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
  }



  public function logout()
  {


    try {

      session()->destroy();
      return redirect()->to(base_url('/auth/login'));
    } catch (Exception $e) {

      echo "Error: " . $e->getMessage();
    }
  }
}
