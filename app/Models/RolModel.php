<?php

namespace App\Models;

use CodeIgniter\Model;


class RolModel extends Model{

  protected $table = 'roles';

  protected $primaryKey = 'id';

  protected $allowedFields = [ 'name' ];


  public function getCountByRoles() {
    $userModel = new \App\Models\UserModel();
    $roles = $this->findAll();
    $result = [];

    foreach ($roles as $role) {
      $roleId = $role['id'];
      $roleName = $role['name'];
      $count = $userModel->where('role_id', $roleId)->countAllResults();
      $result[] = ['name' => $roleName, 'count' => $count];
    }

    return $result;
  }


}