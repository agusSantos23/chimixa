<?php

namespace App\Models;

use CodeIgniter\Model;

class PlateModel extends Model
{
  protected $table = 'plates';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'description', 'price', 'category', 'preparation_time', 'disabled'];

  public function getPlates($perPage = 5, $searchParams = [], $sortBy = 'name', $sortDirection = 'asc')
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
      'description' => 'description',
      'price' => 'price',
      'category' => 'category',
      'preparationTime' => 'preparation_time'
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    $allowedSortFields = [
      'name' => 'name',
      'description' => 'description',
      'price' => 'price',
      'category' => 'category',
      'preparationTime' => 'preparation_time'
    ];

    if (!array_key_exists($sortBy, $allowedSortFields)) {
      $sortBy = 'name';
    }

    $sortDirection = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';
    $builder->orderBy($allowedSortFields[$sortBy], $sortDirection);

    return [
      'plates' => $this->paginate($perPage),
      'pager' => $this->pager
    ];
  }

  public function getPlatesWithDetails(): array{
    $plates = $this->db->table('plates')
      ->select('
        plates.id AS plate_id,
        plates.name AS plate_name,
        plates.price AS plate_price,
        GROUP_CONCAT(DISTINCT ingredients.allergens) AS allergens
    ')
      ->join('store', 'store.id_plate = plates.id')
      ->join('ingredients', 'ingredients.id = store.id_ingredient')
      ->where('plates.disabled IS NULL')
      ->where('ingredients.disabled IS NULL')
      ->groupBy('plates.id')
      ->get()
      ->getResultArray();

    $formattedPlates = [];
    foreach ($plates as $plate) {
      $allergens = explode(',', $plate['allergens']);
      $allergens = array_map(function ($allergen) {
        return trim($allergen, '[]"');
      }, $allergens);
      $allergens = array_filter($allergens);

      $formattedPlates[] = [
        'idPlate' => $plate['plate_id'],
        'namePlate' => $plate['plate_name'],
        'pricePlate' => $plate['plate_price'],
        'ingredientsAllergens' => $allergens
      ];
    }

    return $formattedPlates;
  }
}
