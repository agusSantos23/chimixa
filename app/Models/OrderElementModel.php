<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderElementModel extends Model
{
  protected $table = 'orders_elements';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id_order', 'id_user', 'id_element', 'type_element', 'price', 'amount'];

  public function getUserOrders($userId, $perPage = 5, $searchParams = [], $sortBy = 'id', $sortDirection = 'asc')
  {
    $builder = $this->builder();

    $builder->join('orders', 'orders.id = orders_elements.id_order', 'left');

    $builder->where('orders_elements.id_user', $userId);
    $builder->where('orders.disabled IS NULL'); 
    $builder->where('orders.created_at IS NOT NULL'); 



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

    $builder->distinct()->select('orders.id, orders.price, orders.date, orders_elements.amount, orders.disabled, orders.created_at');

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

      return ['orders' => $builder->get()->getResultArray()];

    } else {

      return [
        'orders' => $this->paginate($perPage),
        'pager' => $this->pager
      ];
    }
    
    
  }
}
