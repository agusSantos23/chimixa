<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';

  protected $primaryKey = 'id';


  protected $allowedFields = ['name', 'lastname', 'email', 'password',  'phone', 'country', 'created_at', 'updated_at', 'disabled', 'role_id', 'prefix'];

  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';


  public function getUserWithRoleById($userId)
  {
    $db = \Config\Database::connect();
    $builder = $db->table($this->table);
    $builder->select('users.id, users.name, users.lastname, users.email, users.password, users.phone, users.country, users.created_at, users.updated_at, users.role_id, users.prefix, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');
    $builder->where('users.id', $userId);
    $builder->where('users.disabled', null);
    $builder->where('roles.disabled', null);
    return $builder->get()->getRow();
  }
  public function getUserWithRoleByEmail($email){
    $db = \Config\Database::connect();
    $builder = $db->table($this->table);
    $builder->select('users.id, users.name, users.lastname, users.email, users.password, users.phone, users.country, users.created_at, users.updated_at, users.role_id, users.prefix, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');
    $builder->where('users.email', $email);
    $builder->where('users.disabled', null);
    $builder->where('roles.disabled', null);
    return $builder->get()->getRow();
}


  public function getAllUsersWithRoles()
  {
    $db = \Config\Database::connect();
    $builder = $db->table($this->table);
    $builder->select('users.id, users.name, users.lastname, users.email, users.password, users.phone, users.country, users.created_at, users.updated_at, users.role_id, users.prefix, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');
    $builder->where('users.disabled', null);
    $builder->where('roles.disabled', null);
    return $builder->get()->getResultArray();
  }
}
