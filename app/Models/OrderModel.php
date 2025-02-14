<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

  protected $table = 'orders';
  protected $primaryKey = 'id';

  protected $allowedFields = ['id_user', 'id_element', 'code', 'type_element', 'amount', 'price', 'disabled'];

  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';

  public function getUserOrder($userId): array
  {
    $db = \Config\Database::connect();

    $orders = $db->table($this->table)
      ->select('id_element, code, type_element, amount, price, created_at, disabled')
      ->where('id_user', $userId)
      ->get()
      ->getResult();

    $orderDetails = [];

    foreach ($orders as $order) {
      $elementTable = ($order->type_element === 'menu') ? 'menus' : 'plates';

      $element = $db->table($elementTable)
        ->select('name')
        ->where('id', $order->id_element)
        ->get()
        ->getRow();

      if ($element) {
        if (!isset($orderDetails[$order->code])) {
          $orderDetails[$order->code] = [
            'code' => $order->code,
            'orderDate' => $order->created_at,
            'disabled' => $order->disabled,
            'elements' => []
          ];
        }

        $orderDetails[$order->code]['elements'][] = [
          'name' => $element->name,
          'type' => $order->type_element, 
          'amount' => $order->amount,
          'price' => $order->price
        ];
      }
    }

    $orderDetails = array_values($orderDetails);

    return $orderDetails;
  }

  public function getUserOrderDetails($userId): array
  {
    $db = \Config\Database::connect();

    $orders = $db->table($this->table)
      ->select('id_element, code, type_element, amount, price, disabled, created_at')
      ->where('id_user', $userId)
      ->get()
      ->getResult();

    $orderDetails = [];

    foreach ($orders as $order) {
      $elementTable = ($order->type_element === 'menu') ? 'menus' : 'plates';

      $element = $db->table($elementTable)
        ->select('name')
        ->where('id', $order->id_element)
        ->get()
        ->getRow();

      if ($element) {
        $orderDetails[$order->code][] = [
          'name' => $element->name,
          'id_element' => $order->id_element,
          'type_element' => $order->type_element,
          'amount' => $order->amount,
          'price' => $order->price,
          'disabled' => $order->disabled,
          'orderDate' => $order->created_at
        ];
      }
    }

    return $orderDetails;
  }
}
