<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model{

  protected $table = 'orders';
  protected $primaryKey = 'id';

  protected $allowedFields = ['id_user', 'id_element', 'code', 'type_element', 'amount','price', 'disabled'];

  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';


  public function getUserOrderDetails($userId): array {
    $db = \Config\Database::connect();

    $builder = $db->table($this->table);
    $builder->where('id_user', $userId);
    $orders = $builder->get()->getResult();

    $orderDetails = [];

    foreach ($orders as $order) {
      $type = $order->type_element;
      $elementTable = ($type === 'menu') ? 'menus' : 'plates';

      $elementBuilder = $db->table($elementTable);
      $elementBuilder->select('name, price, description');
      $elementBuilder->where('id', $order->id_element);
      $element = $elementBuilder->get()->getRow();

      if ($element) {
        $element->orderDate = $order->created_at;
        $element->type = $type;
        $orderDetails[] = (array) $element;
      }
    }

    return $orderDetails;
  }



}