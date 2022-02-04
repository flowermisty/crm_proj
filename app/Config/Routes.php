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
$routes->get('/', 'Event_admin::index');
$routes->match(['get','post'],'init/(:segment)','Event_admin::init/$1');
$routes->match(['get','post'],'eventRegist','Event_admin::eventRegist');
$routes->match(['get','post'],'update/(:any)','Event_admin::update/$1/$1');
$routes->match(['get','post'],'delete','Event_admin::delete');
$routes->match(['get','post'],'excel','ExcelController::index');
$routes->match(['get','post'],'spreadsheet_format_download','ExcelController::spreadsheet_format_download');
$routes->match(['get','post'],'spreadsheet_import','ExcelController::spreadsheet_import');
$routes->match(['get','post'],'step','Event_admin::eventStep');



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
