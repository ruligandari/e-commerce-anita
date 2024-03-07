<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('dashboard', function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
});
