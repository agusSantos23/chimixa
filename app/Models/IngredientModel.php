<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
  protected $table = 'ingredients';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'quantity_available', 'measure', 'expiration_date', 'price', 'allergens', 'disabled'];

  public function getIngredients($perPage = 5, $searchParams = [], $sortBy = 'name', $sortDirection = 'asc')
  {
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
      'quantityAvailable' => 'quantity_available',
      'expirationDate' => 'expiration_date',
      'price' => 'price',
      'allergens' => 'allergens'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    $allowedSortFields = [
      'name' => 'name',
      'quantityAvailable' => 'quantity_available',
      'expirationDate' => 'expiration_date',
      'price' => 'price',
      'allergens' => "JSON_UNQUOTE(JSON_EXTRACT(allergens, '$[0]'))"
    ];

    if (!array_key_exists($sortBy, $allowedSortFields)) {
      $sortBy = 'name';
    }

    $sortDirection = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';
    $builder->orderBy($allowedSortFields[$sortBy] . ' ' . $sortDirection);

    if (isset($searchParams['all']) && $searchParams['all'] == 'true') {

      return $builder->get()->getResultArray();
    } else {
      return [
        'ingredients' => $this->paginate($perPage),
        'pager' => $this->pager
      ];
    }
  }
}
