<?php

use CodeIgniter\Router\RouteCollection;

/**
  * @var RouteCollection $routes
*/

// users
$routes->get('users', 'UserController::index');
$routes->post('users/save', 'UserController::saveUser');
$routes->post('users/save/(:any)', 'UserController::saveUser/$1');
$routes->get('users/delete/(:any)', 'UserController::deleteUser/$1');

// plates
$routes->get('plates', 'PlateController::index');
$routes->post('plates/save', 'PlateController::savePlate');
$routes->post('plates/save/(:any)', 'PlateController::savePlate/$1');
$routes->get('plates/delete/(:any)', 'PlateController::deletePlate/$1');

