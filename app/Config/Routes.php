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



// ingredients
$routes->get('ingredients', 'IngredientController::index');
$routes->get('ingredients/get/(:any)', 'IngredientController::getIngredient/$1');
$routes->post('ingredients/save', 'IngredientController::saveIngredient');
$routes->post('ingredients/update/(:any)', 'IngredientController::saveIngredient/$1');
$routes->post('ingredients/delete', 'IngredientController::deleteIngredient');




// plates
$routes->get('plates', 'PlateController::index');
$routes->post('plates/save', 'PlateController::savePlate');
$routes->post('plates/save/(:any)', 'PlateController::savePlate/$1');
$routes->post('plates/delete', 'PlateController::deletePlate');

$routes->get('plateingredients/(:any)', 'PlateController::ingredientsOfPlate/$1');




// menus
$routes->get('menus', 'MenuController::index');
$routes->get('menus/get/(:any)', 'MenuController::getMenu/$1');
$routes->post('menus/save', 'MenuController::saveMenu');
$routes->post('menus/update/(:any)', 'MenuController::saveMenu/$1');
$routes->post('menus/delete', 'MenuController::deleteMenu');


// menus_plates
$routes->get('menu_plates/(:any)', 'MenuPlateController::index/$1');
$routes->get('menu_platess/get/(:any)', 'MenuPlateController::getPlatesInMenu/$1');
$routes->post('menu_plates/update/(:any)', 'MenuPlateController::savePlateInMenu/$1');
$routes->post('menu_plates/delete/(:any)', 'MenuPlateController::deletePlatesInMenu/$1');



