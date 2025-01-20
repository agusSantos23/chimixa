<?php

use CodeIgniter\Router\RouteCollection;

/**
  * @var RouteCollection $routes
*/

$routes->get('users', 'UserController::index');

$routes->post('users/save', 'UserController::saveUser');
$routes->post('users/save/(:any)', 'UserController::saveUser/$1');
