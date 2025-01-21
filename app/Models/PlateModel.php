<?php

namespace App\Models;

use CodeIgniter\Model;

class PlateModel extends Model{
  protected $table = 'plates';

  protected $primaryKey = 'id';

  protected $allowedFields = [ 'name', 'description', 'price', 'category', 'preparation_time' ];

}