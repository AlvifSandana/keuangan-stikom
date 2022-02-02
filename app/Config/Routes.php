<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// route for login
$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/auth', 'LoginController::auth');

// route for dashboard
$routes->get('/', 'DashboardController::index', ['filter' => 'auth']);
$routes->add('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

// route for keuangan mahasiswa
$routes->get('/keuangan-mahasiswa/pembayaran', 'Mahasiswa/PembayaranController::index', ['filter' => 'auth']);
$routes->post('/keuangan-mahasiswa/pembayaran/create', 'Mahasiswa/PembayaranController::create_pembayaran', ['filter' => 'auth']);
$routes->get('/keuangan-mahasiswa/pembayaran/detail/(:any)', 'Mahasiswa\PembayaranController::detail_keuangan/$1', ['filter' => 'auth']);
$routes->get('/keuangan-mahasiswa/pembayaran/detail-pembayaran-item/(:any)/(:any)', 'Mahasiswa\PembayaranController::get_detail_pembayaran_item/$1/$2', ['filter' => 'auth']);
$routes->post('/keuangan-mahasiswa/cari-mahasiswa', 'Mahasiswa/PembayaranController::search_mahasiswa', ['filter' => 'auth']);
$routes->delete('/keuangan-mahasiswa/pembayaran/delete/(:any)', 'Mahasiswa\PembayaranController::delete_pembayaran/$1', ['filter' => 'auth']);
$routes->post('/keuangan-mahasiswa/tagihan/create', 'Mahasiswa/TagihanController::create_tagihan', ['filter' => 'auth']);

// route for FRS
$routes->get('/keuangan-mahasiswa/frs/(:any)', 'Mahasiswa/FRSController::index', ['filter' => 'auth']);
$routes->post('/keuangan-mahasiswa/frs/(:any)/acc', 'Mahasiswa\FRSController::acc_frs/$1', ['filter' => 'auth']);
$routes->post('/keuangan-mahasiswa/frs/(:any)/batal', 'Mahasiswa\FRSController::batal_frs/$1', ['filter' => 'auth']);

// route for transaksi
$routes->get('/transaksi/pemasukan', 'Transaksi/PemasukanController::index', ['filter' => 'auth']);
$routes->post('/transaksi/pemasukan/create', 'Transaksi/PemasukanController::create_pemasukan', ['filter' => 'auth']);
$routes->get('/transaksi/pengeluaran', 'Transaksi/PengeluaranController::index', ['filter' => 'auth']);
$routes->post('/transaksi/pengeluaran/create', 'Transaksi/PengeluaranController::create_pengeluaran', ['filter' => 'auth']);

// route for master mahasiswa
$routes->get('/master-mahasiswa', 'Master/MahasiswaController::index', ['filter' => 'auth']);

// route for master paket
$routes->get('/master-keuangan/paket', 'Master/PaketController::index', ['filter' => 'auth']);
$routes->post('/master-keuangan/paket/create', 'Master/PaketController::create_paket', ['filter' => 'auth']);
$routes->post('/master-keuangan/paket/update', 'Master\PaketController::update_paket', ['filter' => 'auth']);
$routes->delete('/master-keuangan/paket/delete/(:any)', 'Master\PaketController::delete_paket/$1', ['filter' => 'auth']);

// route for master item paket
$routes->post('/master-keuangan/itempaket/create', 'Master\ItemPaketController::create_item', ['filter' => 'auth']);
$routes->get('/master-keuangan/itempaket/find/(:any)', 'Master\ItemPaketController::find_item_by_id/$1', ['filter' => 'auth']);
$routes->post('/master-keuangan/itempaket/update/(:any)', 'Master\ItemPaketController::update_item/$1', ['filter' => 'auth']);
$routes->delete('/master-keuangan/itempaket/delete/(:any)', 'Master\ItemPaketController::delete_item/$1', ['filter' => 'auth']);
$routes->get('/master-keuangan/itempaket/(:any)', 'Master\PaketController::get_item_paket/$1', ['filter' => 'auth']);

// route for master akun pemasukan
$routes->get('/master-keuangan/akun-pemasukan', 'Master\AkunPemasukanController::index', ['filter' => 'auth']);
$routes->post('/master-keuangan/akun-pemasukan/create', 'Master/AkunPemasukanController::create_akun', ['filter' => 'auth']);
$routes->get('/master-keuangan/akun-pemasukan/find/(:any)', 'Master\AkunPemasukanController::get_akun_by_id/$1', ['filter' => 'auth']);
$routes->post('/master-keuangan/akun-pemasukan/update', 'Master\AkunPemasukanController::update_akun', ['filter' => 'auth']);
$routes->delete('/master-keuangan/akun-pemasukan/delete/(:any)', 'Master\AkunPemasukanController::delete_akun/$1', ['filter' => 'auth']);

// route for master akun pemasukan
$routes->get('/master-keuangan/akun-pengeluaran', 'Master\AkunPengeluaranController::index', ['filter' => 'auth']);
$routes->post('/master-keuangan/akun-pengeluaran/create', 'Master/AkunPengeluaranController::create_akun', ['filter' => 'auth']);
$routes->get('/master-keuangan/akun-pengeluaran/find/(:any)', 'Master\AkunPengeluaranController::get_akun_by_id/$1', ['filter' => 'auth']);
$routes->post('/master-keuangan/akun-pengeluaran/update', 'Master\AkunPengeluaranController::update_akun', ['filter' => 'auth']);
$routes->delete('/master-keuangan/akun-pengeluaran/delete/(:any)', 'Master\AkunPengeluaranController::delete_akun/$1', ['filter' => 'auth']);

// route for master pendukung
$routes->get('/master-pendukung', 'Master/PendukungController::index', ['filter' => 'auth']);
$routes->post('/master-pendukung/create/angkatan', 'Master\AngkatanController::create_angkatan', ['filter' => 'auth']);
$routes->post('/master-pendukung/create/jurusan', 'Master\JurusanController::create_jurusan', ['filter' => 'auth']);
$routes->post('/master-pendukung/create/semester', 'Master\SemesterController::create_semester', ['filter' => 'auth']);
$routes->post('/master-pendukung/update/angkatan/(:any)', 'Master\AngkatanController::update_angkatan/$1', ['filter' => 'auth']);
$routes->post('/master-pendukung/update/jurusan/(:any)', 'Master\JurusanController::update_jurusan/$1', ['filter' => 'auth']);
$routes->post('/master-pendukung/update/semester/(:any)', 'Master\SemesterController::update_semester/$1', ['filter' => 'auth']);
$routes->delete('/master-pendukung/delete/angkatan/(:any)', 'Master\AngkatanController::delete_angkatan/$1', ['filter' => 'auth']);
$routes->delete('/master-pendukung/delete/jurusan/(:any)', 'Master\JurusanController::delete_jurusan/$1', ['filter' => 'auth']);
$routes->delete('/master-pendukung/delete/semester/(:any)', 'Master\SemesterController::delete_semester/$1', ['filter' => 'auth']);


// route for master backup restore database
$routes->get('/backup-restore', 'Master/BackupRestoreController::index');
$routes->get('/backup-restore/backup', 'Master/BackupRestoreController::backup', ['filter' => 'auth']);
$routes->post('/backup-restore/restore', 'Master/BackupRestoreController::restore');

// route for settings
$routes->get('/settings-account', 'Settings/UserController::index', ['filter' => 'auth']);
$routes->post('/settings-account/create', 'Settings/UserController::create', ['filter' => 'auth']);
$routes->post('/settings-account/update/(:any)', 'Settings/UserController::update/$1', ['filter' => 'auth']);
$routes->delete('/settings-account/delete/(:any)', 'Settings/UserController::delete/$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
