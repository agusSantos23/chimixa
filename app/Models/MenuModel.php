<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
  protected $table = 'menus';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'description', 'price', 'disabled'];

  public function getMenus($perPage = 1, $searchParams = []){
    $builder = $this->builder();

    $searchFields = [
      'name' => 'name',
      'description' => 'description',
      'price' => 'price'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    return [
      'menus' => $this->paginate($perPage),
      'pager' => $this->pager
    ];
  }
}
