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
$routes->post('/auth', 'LoginController::auth');

// route for dashboard
$routes->get('/', 'DashboardController::index', ['filter' => 'auth']);
$routes->add('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

// route for transaksi
$routes->get('/transaksi/pemasukan', 'Transaksi/PemasukanController::index', ['filter' => 'auth']);
$routes->get('/transaksi/pengeluaran', 'Transaksi/PengeluaranController::index', ['filter' => 'auth']);

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
