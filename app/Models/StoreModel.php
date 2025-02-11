<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model{

  protected $table = 'store';

  protected $primaryKey = 'id';

  protected $allowedFields = ['id_plate', 'id_ingredient', 'amount', 'disabled'];

  
  public function getIngredientsByPlate($plateId){
    return $this->select('ingredients.name, ingredients.allergens')
      ->join('ingredients', 'ingredients.id = store.id_ingredient') 
      ->where('store.id_plate', $plateId) 
      ->where('store.disabled IS NULL') 
      ->findAll();
  }

}
