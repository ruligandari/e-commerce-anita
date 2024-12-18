<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Admin\AuthController::index');
$routes->post('auth', 'Admin\AuthController::login');
$routes->get('logout', 'Admin\AuthController::logout');

$routes->get('customer/login', 'Admin\AuthController::customer_login');
$routes->get('customer/register', 'Admin\AuthController::customer_register');
$routes->post('customer/auth', 'Admin\AuthController::customer_auth');
$routes->post('customer/auth_register', 'Admin\AuthController::customer_auth_register');
$routes->get('customer/logout', 'Admin\AuthController::customer_logout');

$routes->group('dashboard', ['filter' => 'authAdmin'], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    // produk
    $routes->get('produk', 'Admin\ProdukController::index');
    $routes->get('produk/add', 'Admin\ProdukController::add_produk');
    $routes->post('produk/add', 'Admin\ProdukController::add');
    $routes->get('produk/edit/(:num)', 'Admin\ProdukController::edit_produk/$1');
    $routes->post('produk/edit', 'Admin\ProdukController::edit');
    $routes->post('produk/delete', 'Admin\ProdukController::delete');
    // review
    $routes->get('review', 'Admin\ReviewController::index');
    $routes->get('produk/add', 'Admin\ProdukController::add_produk');
    $routes->post('produk/add', 'Admin\ProdukController::add');
    $routes->get('review/(:any)', 'Admin\ReviewController::detail/$1');
    $routes->get('review/(:any)/(:any)', 'Admin\ReviewController::detail_paginate/$1/$2');
    $routes->post('produk/edit', 'Admin\ProdukController::edit');
    $routes->post('produk/delete', 'Admin\ProdukController::delete');
    // kategori
    $routes->get('kategori', 'Admin\KategoriController::index');
    $routes->post('kategori/add', 'Admin\KategoriController::add');
    $routes->post('kategori/delete', 'Admin\KategoriController::delete');
    $routes->post('kategori/update', 'Admin\KategoriController::update');
    // pesanan
    $routes->get('pesanan', 'Admin\PesananController::index');
    $routes->get('pesanan/detail/(:any)', 'Admin\PesananController::detail/$1');
    $routes->get('pesanan/validasi/(:any)', 'Admin\PesananController::validasi/$1');
    $routes->post('pesanan/kirim_pesanan', 'Admin\PesananController::kirim_pesanan');

    $routes->get('laporan', 'Admin\LaporanController::index');

    $routes->get('user', 'Admin\UserController::index');
});


$routes->get('/', 'user\HomeController::index');
$routes->get('shop', 'user\ShopController::index');
$routes->get('shop/(:num)', 'user\ShopController::detail/$1');
$routes->get('shop/edit/(:num)/(:num)', 'user\ShopController::edit/$1/$2');
$routes->post('shop/process', 'user\ShopController::process');
$routes->post('shop/review', 'user\ShopController::review');
$routes->post('shop/update', 'user\ShopController::update');
$routes->get('shop/keranjang', 'user\ShopController::confirm');
$routes->get('shop/detail/(:any)', 'user\ShopController::detail_pesanan/$1');
$routes->post('shop/detail/terima_pesanan', 'user\ShopController::pesanan_diterima');
$routes->post('shop/checkout', 'user\ShopController::checkout');
$routes->get('shop/checkout/(:any)', 'user\ShopController::pembayaran/$1');
$routes->post('shop/upload_bukti', 'user\ShopController::upload_bukti');
// get pesanan
$routes->post('shop/get_pesanan', 'user\ShopController::get_pesanan');
