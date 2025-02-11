<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuPlateModel extends Model
{

  protected $table = 'menus_plates';

  protected $primaryKey = 'id';

  protected $allowedFields = ['id_menu', 'id_plate', 'amount', 'disabled'];

  public function getPlatesByMenu($menuId, $perPage, $searchParams): array{
    $builder = $this->builder();

    $builder->select('plates.id, plates.name, plates.description, plates.price, plates.category, plates.preparation_time, menus_plates.amount as amount, menus_plates.disabled as disabled');
    $builder->join('plates', 'menus_plates.id_plate = plates.id');

    $builder->where('menus_plates.id_menu', $menuId);


    
    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];
      
      if ($disabledFilter == 'true') {
        $builder->where('plates.disabled IS NOT NULL');

      } elseif ($disabledFilter == 'false') {
        $builder->where('plates.disabled IS NULL'); 
      } 
    }

    $searchFields = [
      'name' => 'plates.name',
      'description' => 'plates.description',
      'price' => 'plates.price',
      'category' => 'plates.category',
      'amount' => 'menus_plates.amount',
      'preparation_time' => 'preparation_time'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    return [
      'platesOfMenu' => $this->paginate($perPage),  
      'pager' => $this->pager,               
    ];
  }
}
