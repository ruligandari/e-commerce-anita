<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Admin\AuthController::index');
$routes->post('auth', 'Admin\AuthController::login');
$routes->get('logout', 'Admin\AuthController::logout');

$routes->group('dashboard', ['filter' => 'authAdmin'], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    // produk
    $routes->get('produk', 'Admin\ProdukController::index');
    $routes->get('produk/add', 'Admin\ProdukController::add_produk');
    $routes->post('produk/add', 'Admin\ProdukController::add');
    $routes->get('produk/edit/(:num)', 'Admin\ProdukController::edit_produk/$1');
    $routes->post('produk/edit', 'Admin\ProdukController::edit');
    $routes->post('produk/delete', 'Admin\ProdukController::delete');
    // kategori
    $routes->get('kategori', 'Admin\KategoriController::index');
    $routes->post('kategori/add', 'Admin\KategoriController::add');
    $routes->post('kategori/delete', 'Admin\KategoriController::delete');
    $routes->post('kategori/update', 'Admin\KategoriController::update');
});


$routes->get('/', 'user\HomeController::index');
$routes->get('shop', 'user\ShopController::index');
