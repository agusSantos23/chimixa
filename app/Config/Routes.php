<?php

use CodeIgniter\Router\RouteCollection;

/**
  * @var RouteCollection $routes
*/

// Basic
$routes->get('/', to: 'Home::index');
$routes->get('about', 'Home::about');


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
$routes->post('users/restore', 'UserController::restoreUser');
$routes->get('users/export', 'UserController::exportUser');


// orders
$routes->get('orders', 'OrderController::index');
$routes->get('orders/get/(:any)', 'OrderController::getOrder/$1');
$routes->post('orders/save', 'OrderController::saveOrder');
$routes->post('orders/delete', 'OrderController::deleteOrder');
$routes->post('orders/restore', 'OrderController::exportRol');




// roles
$routes->get('roles', 'RolController::index');
$routes->get('roles/get/(:any)', 'RolController::getRol/$1');
$routes->post('roles/save', 'RolController::saveRol');
$routes->post('roles/update/(:any)', 'RolController::saveRol/$1');
$routes->post('roles/delete', 'RolController::deleteRol');
$routes->post('roles/restore', 'RolController::restoreRol');
$routes->get('roles/export', 'RolController::exportRol');





// ingredients
$routes->get('ingredients', 'IngredientController::index');
$routes->get('ingredients/get/(:any)', 'IngredientController::getIngredient/$1');
$routes->post('ingredients/save', 'IngredientController::saveIngredient');
$routes->post('ingredients/update/(:any)', 'IngredientController::saveIngredient/$1');
$routes->post('ingredients/delete', 'IngredientController::deleteIngredient');
$routes->post('ingredients/restore', 'IngredientController::restoreIngredient');




// store
$routes->get('store/(:any)', 'StoreController::index/$1');
$routes->get('storer/get/(:any)', 'StoreController::getPlatesInMenu/$1');
$routes->post('store/update/(:any)', 'StoreController::saveIngredientInPlate/$1');
$routes->post('store/delete/(:any)', 'StoreController::deleteIngredientsInPlate/$1');
$routes->get('storer/export/(:any)', 'StoreController::exportIngredientsInPlate/$1');



// plates
$routes->get('plates', 'PlateController::index');
$routes->get('plates/get/(:any)', 'PlateController::getPlate/$1');
$routes->post('plates/save', 'PlateController::savePlate');
$routes->post('plates/update/(:any)', 'PlateController::savePlate/$1');
$routes->post('plates/delete', 'PlateController::deletePlate');
$routes->post('plates/restore', 'PlateController::restorePlate');
$routes->get('plates/export', 'PlateController::exportPlate');



// menus_plates
$routes->get('menu_plates/(:any)', 'MenuPlateController::index/$1');
$routes->get('menu_platess/get/(:any)', 'MenuPlateController::getPlatesInMenu/$1');
$routes->post('menu_plates/update/(:any)', 'MenuPlateController::savePlateInMenu/$1');
$routes->post('menu_plates/delete/(:any)', 'MenuPlateController::deletePlatesInMenu/$1');
$routes->get('menu_platess/export/(:any)', 'MenuPlateController::exportPlatesInMenu/$1');




// menus
$routes->get('menus', 'MenuController::index');
$routes->get('menus/get/(:any)', 'MenuController::getMenu/$1');
$routes->post('menus/save', 'MenuController::saveMenu');
$routes->post('menus/update/(:any)', 'MenuController::saveMenu/$1');
$routes->post('menus/delete', 'MenuController::deleteMenu');
$routes->post('menus/restore', 'MenuController::restoreMenu');
$routes->get('menus/export', 'MenuController::exportMenu');



// calendar
$routes->get('calendar', 'EventOrderController::index');
$routes->get('calendar/ajax', 'EventOrderController::ajaxEvents');
$routes->post('calendar/save/(:any)', 'EventOrderController::saveEvent/$1');
$routes->get('calendar/delete/(:any)', 'EventOrderController::deleteEvent/$1');