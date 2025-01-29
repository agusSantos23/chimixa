<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model{

  protected $table = 'ingredients';

  protected $primaryKey = 'id';

  protected $allowedFields = [ 'name', 'quantity_available', 'unit', 'expiration_date', 'price', 'allergens', 'disabled'];

}