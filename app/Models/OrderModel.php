<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
  protected $table = 'orders';
  protected $primaryKey = 'id';
  protected $allowedFields = ['price', 'disabled'];

  public function getAllOrders($perPage = 5, $searchParams = [])
  {
    $builder = $this->builder();

    $searchFields = [
      'id' => 'orders.id',
      'date' => 'orders.created_at',
      'price' => 'orders.price',
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    $builder->select('orders.id, orders.price, orders.created_at, orders.disabled');

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
