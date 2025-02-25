<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
  protected $table = 'roles';
  protected $primaryKey = 'id';
  protected $allowedFields = ['name', 'disabled'];

  public function getRoles($perPage = 5, $searchParams = [], $sortBy = 'name', $sortDirection = 'asc')
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

    if (!empty($searchParams['name'])) {
      $builder->like('name', $searchParams['name']);
    }

    $allowedSortFields = [
      'id' => 'roles.id',
      'name' => 'roles.name',
      'disabled' => 'roles.disabled'
    ];

    if (!array_key_exists($sortBy, $allowedSortFields)) {
      $sortBy = 'name';
    }

    $sortDirection = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';

    $builder->orderBy($allowedSortFields[$sortBy], $sortDirection);


    if (isset($searchParams['all']) && $searchParams['all'] == 'true') {

      return $builder->get()->getResultArray();

    } else {
      
      return [
        'roles' => $this->paginate($perPage),
        'pager' => $this->pager
      ];
    }
  }

  public function getIdByName($roleName)
  {
    return $this->where('name', $roleName)->where('disabled IS NULL')->first()['id'] ?? null;
  }
}
