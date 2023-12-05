<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'DashboardController::dashboard');

$routes->get('/supply', 'SupplyController::index');
$routes->get('/tambahSupply', 'SupplyController::tambahS');
$routes->post('/storeSupply','SupplyController::storeSupply');
$routes->get('/editSupply/(:num)','SupplyController::editSupply/$1');
$routes->post('/updateSupply/(:num)','SupplyController::updateSupply/$1');
$routes->delete('/hapusSupply/(:num)', 'SupplyController::hapusSupply/$1');

$routes->get('/produk', 'ProdukController::viewProduk');
$routes->post('/storeProduk','ProdukController::storeProduk');
$routes->post('/kurangjumlahProduk/(:num)','ProdukController::kurangjumlahProduk/$1');
$routes->post('/tambahjumlahProduk/(:num)','ProdukController::tambahjumlahProduk/$1');
$routes->add('produk/edit/(:segment)', 'ProdukController::edit/$1');
$routes->get('produk/delete/(:segment)', 'ProdukController::delete/$1');

$routes->get('/transaksi', 'TransaksiController::index');

$routes->get('/keuangan', 'KeuanganController::index');
$routes->get('/tambahPemasukan', 'KeuanganController::tambahK');
$routes->post('/storeK','KeuanganController::storeK');
$routes->get('/editPemasukan/(:num)','KeuanganController::editPemasukan/$1');
$routes->post('/updatePemasukan/(:num)','KeuanganController::updatePemasukan/$1');
$routes->delete('/hapusPemasukan/(:num)', 'KeuanganController::hapusPemasukan/$1');
$routes->get('/tambahPengeluaran', 'KeuanganController::tambahPengeluaran');
$routes->post('/storePengeluaran','KeuanganController::storePengeluaran');
$routes->get('/editPengeluaran/(:num)','KeuanganController::editPengeluaran/$1');
$routes->post('/updatePengeluaran/(:num)','KeuanganController::updatePengeluaran/$1');
$routes->delete('/hapusPengeluaran/(:num)', 'KeuanganController::hapusPengeluaran/$1');





