<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuPlateModel extends Model
{

  protected $table = 'menus_plates';

  protected $primaryKey = 'id';

  protected $allowedFields = ['id_menu', 'id_plate', 'amount', 'disabled'];

  public function getMenuWithPlates($menu_id): array{
    $builder = $this->db->table('plates');
    $builder->select('plates.id, plates.name, plates.description, plates.price, plates.category, plates.preparation_time');
    $builder->join('menus_plates', 'menus_plates.id_plate = plates.id');
    $builder->where('menus_plates.id_menu', $menu_id);
    $query = $builder->get();

    return $query->getResultArray();
  }
}
