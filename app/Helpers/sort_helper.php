<?php

if (!function_exists('generateSortLink')) {
  function generateSortLink($column, $sortBy, $sortDirection, $searchParams, $perPage, $route = 'users', $idElement = null)
  {
    if (empty($idElement)) {
      $newDirection = ($sortBy === $column && $sortDirection === 'asc') ? 'desc' : 'asc';

      $url = base_url("/$route?" . http_build_query([
        'searchParams' => $searchParams,
        'sortBy' => $column,
        'sortDirection' => $newDirection,
        'perPage' => $perPage
      ]));
    }else{
      $newDirection = ($sortBy === $column && $sortDirection === 'asc') ? 'desc' : 'asc';

      $url = base_url("/$route/$idElement?" . http_build_query([
        'searchParams' => $searchParams,
        'sortBy' => $column,
        'sortDirection' => $newDirection,
        'perPage' => $perPage
      ]));

    }

    return $url;
  }
}

if (!function_exists('getSortIcon')) {
  function getSortIcon($column, $sortBy, $sortDirection)
  {
    if ($sortBy === $column) {
      return $sortDirection === 'asc' ? '🔼' : '🔽';
    }
    return '';
  }
}
