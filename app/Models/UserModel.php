<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';

  protected $primaryKey = 'id';

  protected $allowedFields = ['name', 'last_name', 'email', 'password',  'phone', 'country', 'created_at', 'updated_at', 'disabled', 'role_id', 'prefix', 'img'];

  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';


  public function getUserWithRoleById($userId)
  {
    $builder = $this->builder();
    $builder->select('users.id, users.name, users.last_name, users.email, users.disabled, users.phone, users.country, users.created_at, users.updated_at, users.role_id, users.prefix, users.img, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');
    $builder->where('users.id', $userId);

    return $builder->get()->getRow();
  }

  public function getUserWithRoleByEmail($email)
  {
    $builder = $this->builder();
    $builder->select('users.id, users.name, users.last_name, users.email, users.password, users.phone, users.country, users.created_at, users.updated_at, users.role_id, users.prefix, users.img, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');
    $builder->where('users.email', $email);

    return $builder->get()->getRow();
  }


  public function getAllUsersWithRoles($perPage = 5, $searchParams = [], $sortBy = 'name', $sortDirection = 'asc')
  {
    $builder = $this->builder();
    $builder->select('users.id, users.name, users.last_name, users.email, users.disabled, users.phone, users.country, users.created_at, users.updated_at, users.role_id, users.prefix, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');


    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];

      if ($disabledFilter == 'true') {
        $builder->where('users.disabled IS NOT NULL');
      } elseif ($disabledFilter == 'false') {
        $builder->where('users.disabled IS NULL');
      }
    }

    $searchFields = [
      'name' => 'users.name',
      'email' => 'users.email',
      'country' => 'users.country',
      'role' => 'roles.name'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }


    if (!empty($searchParams['phone'])) {
      $builder->groupStart()
        ->like('users.prefix', $searchParams['phone'])
        ->orLike('users.phone', $searchParams['phone'])
        ->groupEnd();
    }

    $allowedSortFields = [
      'name' => 'users.name',
      'email' => 'users.email',
      'phone' => 'users.prefix',
      'country' => 'users.country',
      'role' => 'roles.name'
    ];

    if (!array_key_exists($sortBy, $allowedSortFields)) {
      $sortBy = 'name';
    }

    $sortDirection = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';
    $builder->orderBy($allowedSortFields[$sortBy], $sortDirection);


    return [
      'users' => $this->paginate($perPage),
      'pager' => $this->pager,
    ];
  }
}
