<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
  protected $table = 'menus';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'description', 'price', 'disabled'];

  public function getMenus($perPage = 5, $searchParams = []){
    $builder = $this->builder();

    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];
      
      if ($disabledFilter == 'true') {
        $builder->where('disabled IS NOT NULL');

      } elseif ($disabledFilter == 'false') {
        $builder->where('disabled IS NULL'); 
      } 
    }

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
