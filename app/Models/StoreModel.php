<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model{

  protected $table = 'store';

  protected $primaryKey = 'id';

  protected $allowedFields = ['id_plate', 'id_ingredient', 'disabled'];

  
  public function getIngredientsByPlate($plateId , $perPage, $searchParams){
    $builder = $this->builder();

    $builder->select('ingredients.id, ingredients.name, ingredients.allergens, store.disabled');
    $builder->join('ingredients', 'ingredients.id = store.id_ingredient');
    $builder->where('store.id_plate', $plateId);


    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];
      
      if ($disabledFilter == 'true') {
        $builder->where('store.disabled IS NOT NULL');

      } elseif ($disabledFilter == 'false') {
        $builder->where('store.disabled IS NULL'); 
      } 
    }

    $searchFields = [
      'name' => 'ingredients.name',
      'allergens' => 'ingredients.allergens',
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

      
    return [
      'ingredientsOfPlate' => $this->paginate($perPage),  
      'pager' => $this->pager,               
    ];
  }

}
