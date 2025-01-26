<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuPlateModel extends Model{

  protected $table = 'menus_plates';

  protected $primaryKey = 'id';

  protected $allowedFields = [ 'id_menu', 'id_plate', 'amount', 'disabled' ];

}