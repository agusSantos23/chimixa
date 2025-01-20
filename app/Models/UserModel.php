<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
  protected $table = 'users';

  protected $primaryKey = 'id';

  protected $useTimestamps = true;

  protected $allowedFields = [ 'name', 'email', 'password', 'lastname', 'phone', 'country', 'role', 'created_at', 'updated_at' ];

  protected $createdField = 'created_at'; 
  protected $updatedField = 'updated_at';
}