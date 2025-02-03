<?php

namespace App\Models;

use CodeIgniter\Model;

class PlateModel extends Model{
  protected $table = 'plates';
  protected $primaryKey = 'id';
  protected $allowedFields = [ 'name', 'description', 'price', 'category', 'preparation_time', 'disabled' ];

  public function getPlates($perPage = 1, $searchParams = []) {
    $builder = $this->builder();

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
