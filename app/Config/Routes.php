<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Admin\AuthController::index');
$routes->post('auth', 'Admin\AuthController::login');
$routes->get('logout', 'Admin\AuthController::logout');

$routes->group('dashboard', ['filter' => 'authAdmin'], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('produk', 'Admin\ProdukController::index');
});
