<?php

use CodeIgniter\Router\RouteCollection;

/**
  * @var RouteCollection $routes
*/

// Basic
$routes->get('/', to: 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('calendar', 'Home::calendar');


// Profile
$routes->get('profile', 'ProfileController::profile');
$routes->get('profile/logout', 'ProfileController::logout');



// authentication
$routes->get('auth/login','AuthController::loginForm');
$routes->get('auth/register','AuthController::registerForm');
$routes->post('auth/login','AuthController::login');
$routes->post('auth/register','AuthController::register');



// users
$routes->get('users', to: 'UserController::index');
$routes->get('users/get/(:any)', 'UserController::getUser/$1');
$routes->post('users/save', 'UserController::saveUser');
$routes->post('users/update/(:any)', 'UserController::saveUser/$1');
$routes->post('users/delete', 'UserController::deleteUser');


// orders
$routes->get('orders', 'OrderController::index');



// roles
$routes->get('roles', 'RolController::index');
$routes->get('roles/get/(:any)', 'RolController::getRol/$1');
$routes->post('roles/save', 'RolController::saveRol');
$routes->post('roles/update/(:any)', 'RolController::saveRol/$1');
$routes->post('roles/delete', 'RolController::deleteRol');






// plates
$routes->get('plates', 'PlateController::index');
$routes->post('plates/save', 'PlateController::savePlate');
$routes->post('plates/save/(:any)', 'PlateController::savePlate/$1');
$routes->get('plates/delete/(:any)', 'PlateController::deletePlate/$1');

$routes->get('plateingredients/(:any)', 'PlateController::ingredientsOfPlate/$1');


// ingredients
$routes->get('ingredients', 'IngredientController::index');
$routes->post('ingredients/save', 'IngredientController::saveIngredient');
$routes->post('ingredients/save/(:any)', 'IngredientController::saveIngredient/$1');
$routes->get('ingredients/delete/(:any)', 'IngredientController::deleteIngredient/$1');

// menus
$routes->get('menus', 'MenuController::index');
$routes->post('menus/save', 'MenuController::saveMenu');
$routes->post('menus/save/(:any)', 'MenuController::saveMenu/$1');
$routes->get('menus/delete/(:any)', 'MenuController::deleteMenu/$1');

$routes->get('menuplates/(:any)', 'MenuController::platesOfMenu/$1');

