<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model{
  protected $table = 'ingredients';
  protected $primaryKey = 'id';
  protected $allowedFields = [ 'name', 'quantity_available', 'unit', 'expiration_date', 'price', 'allergens', 'disabled' ];

  public function getIngredients($perPage = 1, $searchParams = []) {
    $builder = $this->builder();

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
