<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
  protected $table = 'roles';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'disabled'];

  public function getCountByRoles($perPage = 1, $searchParams = [])
  {
    $userModel = new \App\Models\UserModel();

    $builder = $this->builder();

    if (!empty($searchParams['name'])) $builder->like('name', $searchParams['name']);

    $roles = $this->paginate($perPage);
    $pager = $this->pager;

    foreach ($roles as &$role) {
      $role['count'] = $userModel->where('role_id', $role['id'])->countAllResults();
    }

    return [
      'roles' => $roles,
      'pager' => $pager
    ];
  }


  public function deleteIds($ids){

    return $this->db->table($this->table)->whereIn('id', $ids)->delete();
    
  }

}
