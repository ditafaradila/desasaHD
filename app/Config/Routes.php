<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'DashboardController::dashboard');
$routes->get('/supply', 'SupplyController::index');
$routes->get('/produk', 'ProdukController::viewProduk');
$routes->get('/keuangan', 'KeuanganController::index');
$routes->get('/transaksi', 'TransaksiController::index');
$routes->get('/tambahPemasukan', 'KeuanganController::tambahK');
$routes->post('/storeK','KeuanganController::storeK');
$routes->get('/editPemasukan/(:num)','KeuanganController::editPemasukan/$1');
$routes->get('/tambahSupply', 'SupplyController::tambahS');