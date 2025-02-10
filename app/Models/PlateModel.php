<?php

namespace App\Models;

use CodeIgniter\Model;

class PlateModel extends Model{
  protected $table = 'plates';
  protected $primaryKey = 'id';
  protected $allowedFields = [ 'name', 'description', 'price', 'category', 'preparation_time', 'disabled' ];

  public function getPlates($perPage = 5, $searchParams = []) {
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
      'price' => 'price',
      'category' => 'category',
      'preparation_time' => 'preparation_time'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    return [
      'plates' => $this->paginate($perPage),
      'pager' => $this->pager
    ];
  }
}
