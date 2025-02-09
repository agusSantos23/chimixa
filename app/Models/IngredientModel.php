<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model{
  protected $table = 'ingredients';
  protected $primaryKey = 'id';
  protected $allowedFields = [ 'name', 'quantity_available', 'measure', 'expiration_date', 'price', 'allergens', 'disabled' ];

  public function getIngredients($perPage = 5, $searchParams = []) {
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
      'quantity_available' => 'quantity_available',
      'expiration_date' => 'expiration_date',
      'price' => 'price',
      'allergens' => 'allergens'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    return [
      'ingredients' => $this->paginate($perPage),
      'pager' => $this->pager
    ];
  }
}
