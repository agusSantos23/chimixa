<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
  protected $table = 'roles';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'disabled'];

  public function getCountByRoles($perPage = 5, $searchParams = [])
  {
    $userModel = new \App\Models\UserModel();

    $builder = $this->builder();

    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];

      if ($disabledFilter == 'true') {
        $builder->where('disabled IS NOT NULL');
      } elseif ($disabledFilter == 'false') {
        $builder->where('disabled IS NULL');
      }
    }

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



  public function getIdByName($roleName)
  {
    return $this->where('name', $roleName)
      ->where('disabled IS NULL')
      ->first()['id'] ?? null;
  }

  public function getActiveRolesExcludingAdmin()
  {
    return $this->whereNotIn('name', ['Administrator'])
      ->where('disabled', null)
      ->findAll();
  }




  public function deactivateIds($ids, $currentDate)
  {

    return $this->db->table($this->table)
      ->whereIn('id', $ids)
      ->update(['disabled' => $currentDate]);
  }
}
