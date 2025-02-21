<?php

if (!function_exists('generateSortLink')) {
  function generateSortLink($column, $sortBy, $sortDirection, $searchParams, $perPage, $route = 'users')
  {
    $newDirection = ($sortBy === $column && $sortDirection === 'asc') ? 'desc' : 'asc';

    return base_url("/$route?" . http_build_query([
      'searchParams' => $searchParams,
      'sortBy' => $column,
      'sortDirection' => $newDirection,
      'perPage' => $perPage
    ]));
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
