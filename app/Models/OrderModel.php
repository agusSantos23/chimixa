<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
  protected $table = 'orders';
  protected $primaryKey = 'id';
  protected $allowedFields = ['price', 'date', 'disabled'];

  public function getAllOrders($perPage = 5, $searchParams = [], $sortBy = 'id', $sortDirection = 'asc')
  {
    $builder = $this->builder();

    $searchFields = [
      'id' => 'orders.id',
      'date' => 'orders.date',
      'price' => 'orders.price',
    ];

    foreach ($searchFields as $key => $field) {
      if (!empty($searchParams[$key])) {
        $builder->like($field, $searchParams[$key]);
      }
    }

    $builder->select('orders.id, orders.price, orders.date, orders.disabled');

    if (isset($searchParams['disabledFilter'])) {
      $disabledFilter = $searchParams['disabledFilter'];

      if ($disabledFilter == 'true') {
        $builder->where('disabled IS NOT NULL');
      } elseif ($disabledFilter == 'false') {
        $builder->where('disabled IS NULL');
      }
    }


    $allowedSortFields = [
      'id' => 'orders.id',
      'date' => 'orders.date',
      'price' => 'orders.price',
    ];

    if (!array_key_exists($sortBy, $allowedSortFields)) {
      $sortBy = 'id';
    }

    $sortDirection = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';
    $builder->orderBy($allowedSortFields[$sortBy], $sortDirection);

    if (isset($searchParams['all']) && $searchParams['all'] == 'true') {

      return $builder->get()->getResultArray();
    } else {
      return [
        'orders' => $this->paginate($perPage),
        'pager' => $this->pager
      ];
    }
  }
}
