<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

  protected $table = 'menus';

  protected $primaryKey = 'id';

  protected $allowedFields = ['name', 'description', 'price', 'disabled'];


  public function getAllMenusWithPlates(){
    $builder = $this->db->table('menus');
    $builder->select('menus.id AS menu_id, 
                          menus.name AS menu_name, 
                          menus.description AS menu_description, 
                          menus.price AS menu_price, 
                          plates.id AS plate_id, 
                          plates.name AS plate_name, 
                          plates.price AS plate_price, 
                          plates.category AS plate_category, 
                          menus_plates.amount AS plate_amount');
    $builder->join('menus_plates', 'menus.id = menus_plates.id_menu', 'inner');
    $builder->join('plates', 'plates.id = menus_plates.id_plate', 'inner');
    $builder->where('menus.disabled', NULL);
    $builder->where('plates.disabled', NULL);
    $builder->where('menus_plates.disabled', NULL);

    $query = $builder->get();
    return $query->getResult();
  }
}
