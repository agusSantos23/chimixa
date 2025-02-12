<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
  protected $table = 'menus';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'description', 'price', 'disabled'];

  public function getMenus($perPage = 5, $searchParams = [])
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



  public function getMenusWithDetails()
  {
    $menus = $this->db->table('menus')
      ->select('
      menus.id AS menu_id, menus.name AS menu_name, menus.price AS menu_price,
      menus_plates.amount AS plate_amount,
      plates.id AS plate_id, plates.name AS plate_name,
      GROUP_CONCAT(DISTINCT ingredients.allergens) AS allergens
    ')
      ->join('menus_plates', 'menus_plates.id_menu = menus.id')
      ->join('plates', 'plates.id = menus_plates.id_plate')
      ->join('store', 'store.id_plate = plates.id')
      ->join('ingredients', 'ingredients.id = store.id_ingredient')
      ->where('menus.disabled IS NULL')
      ->where('plates.disabled IS NULL')
      ->where('ingredients.disabled IS NULL')
      ->groupBy('menus.id, plates.id')
      ->get()
      ->getResultArray();

    $formattedMenus = [];
    foreach ($menus as $menu) {
      if (!isset($formattedMenus[$menu['menu_id']])) {

        $formattedMenus[$menu['menu_id']] = [
          'idMenu' => $menu['menu_id'],
          'nameMenu' => $menu['menu_name'],
          'priceMenu' => $menu['menu_price'],
          'plates' => []
        ];
      }

      $formattedMenus[$menu['menu_id']]['plates'][] = [
        'idPlate' => $menu['plate_id'],
        'namePlate' => $menu['plate_name'],
        'amountPlate' => $menu['plate_amount'],
        'ingredients' => json_decode($menu['allergens'], true)
      ];
    }

    return array_values($formattedMenus);
  }
}
