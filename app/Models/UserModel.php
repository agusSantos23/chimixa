<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
  protected $table = 'users';

  protected $primaryKey = 'id';


  protected $allowedFields = [ 'name', 'email', 'password', 'lastname', 'phone', 'country', 'role_id', 'created_at', 'updated_at' ];

  protected $useTimestamps = true;
  protected $createdField = 'created_at'; 
  protected $updatedField = 'updated_at';

  /**
  * Obtener un usuario con su rol.
  * 
  * @param string $userId
  * @return object|null
  */

  public function getUserWithRole($userId){

    $db = \Config\Database::connect(); 
    $builder = $db->table($this->table);
    $builder->select('users.*, roles.name as role_name'); 
    $builder->join('roles', 'roles.id = users.role_id'); 
    $builder->where('users.id', $userId); 
    return $builder->get()->getRow(); 
  }

  /**
 * Obtener todos los usuarios con sus roles.
 * 
 * @return array
 */
  public function getAllUsersWithRoles() {
    $db = \Config\Database::connect();
    $builder = $db->table($this->table);
    $builder->select('users.*, roles.name as role_name');
    $builder->join('roles', 'roles.id = users.role_id');
    return $builder->get()->getResultArray(); // Cambiado a getResultArray()
  }


}