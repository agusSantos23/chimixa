<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderElementModel extends Model
{
  protected $table = 'orders_elements';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id_order', 'id_user', 'id_element', 'type_element', 'price', 'amount'];

  public function getUserOrders($userId, $perPage = 5, $searchParams = [])
  {
    $builder = $this->builder();

    $builder->join('orders', 'orders.id = orders_elements.id_order', 'left');

    $builder->where('orders_elements.id_user', $userId);

    $searchFields = [
      'id' => 'orders.id',
      'date' => 'orders.created_at',
      'price' => 'orders.price',
      'created_at' => 'orders.created_at' 
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    $builder->distinct()->select('orders.id, orders.price, orders.created_at, orders.disabled'); 

    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];

      if ($disabledFilter == 'true') {
        $builder->where('disabled IS NOT NULL');
      } elseif ($disabledFilter == 'false') {
        $builder->where('disabled IS NULL');
      }
    }

    return [
      'orders' => $this->paginate($perPage),
      'pager' => $this->pager 
    ];
  }
}
