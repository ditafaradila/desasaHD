<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::index');
$routes->get('/dashboard', 'DashboardController::dashboard', ['filter' => 'auth']);
$routes->post('login', 'Auth::login'); // Menangani permintaan POST untuk login
$routes->get('/logout', 'Auth::logout');

$routes->get('/api', 'ShopeeController::index');
$routes->post('/auth', 'ShopeeController::auth');
$routes->post('/process', 'ShopeeController::process');
$routes->post('/processRefreshToken', 'ShopeeController::processRefreshToken');
$routes->post('/getItemList', 'ShopeeController::getItemList');
$routes->post('/showItemList', 'ShopeeController::showItemList');
$routes->post('/getOrderList', 'ShopeeController::getOrderList');
$routes->post('/showOrderList', 'ShopeeController::showOrderList');
$routes->post('/getOrderDetail', 'ShopeeController::getOrderDetail');
$routes->post('/getDetailOrderList', 'ShopeeController::getDetailOrderList');

$routes->get('/supply', 'SupplyController::index',['filter' => 'auth']);
$routes->get('/detailBarangMasuk', 'SupplyController::detail');
$routes->get('/tambahSupply', 'SupplyController::tambahS');
$routes->post('/storeSupply','SupplyController::storeSupply');
$routes->get('/editSupply/(:num)','SupplyController::editSupply/$1');
$routes->add('/updateSupply/(:segment)','SupplyController::updateSupply/$1');
$routes->get('/hapusSupply/(:segment)', 'SupplyController::hapusSupply/$1');
$routes->get('/detailBarangKeluar', 'SupplyController::detailBarangKeluar');
$routes->get('/tambahBarangKeluar', 'SupplyController::tambahBarangKeluar');
$routes->post('/storeBK','SupplyController::storeBK');
$routes->add('/updateBK/(:segment)','SupplyController::updateBK/$1');
$routes->get('/hapusBK/(:segment)', 'SupplyController::hapusBK/$1');

$routes->get('/bahanbaku', 'BarangController::index',['filter' => 'auth']);
$routes->post('/storeBahanBaku','BarangController::storeBahanBaku');
$routes->get('/hapusjenisBarang/(:segment)', 'BarangController::hapusjenisBarang/$1');
$routes->add('/updateBahanBaku/(:segment)','BarangController::updateBahanBaku/$1');

$routes->get('/produk', 'ProdukController::viewProduk',['filter' => 'auth']);
$routes->get('/produkShopee','ProdukController::viewShopee');
$routes->post('/storeProduk','ProdukController::storeProduk');
$routes->post('/kurangjumlahProduk/(:num)','ProdukController::kurangjumlahProduk/$1');
$routes->post('/tambahjumlahProduk/(:num)','ProdukController::tambahjumlahProduk/$1');
$routes->add('produk/edit/(:segment)', 'ProdukController::edit/$1');
$routes->get('produk/delete/(:segment)', 'ProdukController::delete/$1');

$routes->get('/transaksi', 'TransaksiController::index',['filter' => 'auth']);
$routes->get('get_harga/(:num)', 'TransaksiController::getHarga/$1');
$routes->post('/storeTransaksi','TransaksiController::storeTransaksi');
$routes->get('/hapusTransaksi/(:segment)', 'TransaksiController::hapusTransaksi/$1');
$routes->add('/updateTransaksi/(:segment)','TransaksiController::updateTransaksi/$1');
$routes->get('/laporanToko', 'TransaksiController::cetakToko');
$routes->get('api_result', 'TransaksiController::getOrders');

$routes->get('/listKeuangan', 'KeuanganController::indexx');
$routes->get('/keuangan', 'KeuanganController::index');
$routes->get('/detailPemasukan/(:any)', 'KeuanganController::detailIn/$1');
$routes->get('/detailPengeluaran/(:any)', 'KeuanganController::detailOut/$1');
$routes->get('/tambahPemasukan', 'KeuanganController::tambahK');
$routes->post('/storeK','KeuanganController::storeK');
$routes->get('/editPemasukan/(:num)','KeuanganController::editPemasukan/$1');
$routes->add('/updatePemasukan/(:segment)','KeuanganController::updatePemasukan/$1');
$routes->get('/hapusPemasukan/(:segment)', 'KeuanganController::hapusPemasukan/$1');
$routes->get('/tambahPengeluaran', 'KeuanganController::tambahPengeluaran');
$routes->post('/storePengeluaran','KeuanganController::storePengeluaran');
$routes->get('/editPengeluaran/(:num)','KeuanganController::editPengeluaran/$1');
$routes->add('/updatePengeluaran/(:segment)','KeuanganController::updatePengeluaran/$1');
$routes->get('/hapusPengeluaran/(:segment)', 'KeuanganController::hapusPengeluaran/$1');
$routes->get('/laporanKeuangan', 'KeuanganController::cetak');





