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

//login
$routes->get('/', 'LoginController::index');
$routes->match(['get','post'],'/login/init','LoginController::loginInit');
$routes->match(['get','post'],'/logout','LoginController::logOut');
$routes->match(['get','post'],'/profile','LoginController::profile');
$routes->match(['get','post'],'/employeeRegist','LoginController::employeeRegist');
$routes->match(['get','post'],'/employeeUpdate','LoginController::employeeUpdate');
$routes->match(['get','post'],'/idDuplCheck','LoginController::IdDuplCheck');


$routes->get('/event_admin_old', 'EventAdminOldController::index');
$routes->match(['get','post'],'init/(:segment)','EventAdminOldController::init/$1');
$routes->match(['get','post'],'eventRegist','EventAdminOldController::eventRegist');
$routes->match(['get','post'],'getEventList','EventAdminOldController::getEventList');
$routes->match(['get','post'],'update/(:any)','EventAdminOldController::update/$1/$1');
$routes->match(['get','post'],'delete','EventAdminOldController::delete');

//이벤트 관리자 인터페이스 UI변경 mapping
$routes->get('/eventAdmin', 'EventAdminNewController::index');
$routes->match(['get','post'],'event_admin_new/eventRegist','EventAdminNewController::eventRegist');
$routes->match(['get','post'],'event_admin_new/getEventList','EventAdminNewController::getEventList');
$routes->match(['get','post'],'event_admin_new/update/(:any)','EventAdminNewController::update/$1/$1');
$routes->match(['get','post'],'event_admin_new/init/(:segment)','EventAdminNewController::init/$1');
$routes->match(['get','post'],'event_admin_new/delete','EventAdminNewController::delete');

//엑셀 import/export 관련 기능 URI mapping
$routes->match(['get','post'],'excel','ExcelController::index');
$routes->match(['get','post'],'spreadsheet_format_download','ExcelController::spreadsheet_format_download');
$routes->match(['get','post'],'spreadsheet_import','ExcelController::spreadsheet_import');
$routes->match(['get','post'],'step','Event_admin::eventStep');



//이벤트 스케줄 캘린더 URI mapping
$routes->match(['get','post'],'event_admin_new/schedule','EventScheduleController::index');
$routes->match(['get','post'],'event_admin_new/schedule/load','EventScheduleController::load');
$routes->match(['get','post'],'event_admin_new/schedule/insert','EventScheduleController::insert');
$routes->match(['get','post'],'event_admin_new/schedule/update','EventScheduleController::update');
$routes->match(['get','post'],'event_admin_new/schedule/delete','EventScheduleController::delete');

//주문서 변환

//자가사용변경
$routes->match(['get','post'],'convert/self','orderConvert/SelfConvertController::index');
$routes->match(['get','post'],'convert/self/selfConvert','orderConvert/SelfConvertController::selfConvert');


//->식품이력 변경
$routes->match(['get','post'],'convert/foodHistory','orderConvert/FoodHistoryController::index');
$routes->match(['get','post'],'convert/foodHistory/foodConvert1','orderConvert/FoodHistoryController::foodConvert1');
$routes->match(['get','post'],'convert/foodHistory/foodConvert2','orderConvert/FoodHistoryController::foodConvert2');
$routes->match(['get','post'],'convert/foodHistory/foodConvert3','orderConvert/FoodHistoryController::foodConvert3');

//->마트변환
$routes->match(['get','post'],'convert/mart','orderConvert/MartConvertController::index');
$routes->match(['get','post'],'convert/mart/martConvert','orderConvert/MartConvertController::martConvert');


//->ERP 변환
$routes->match(['get','post'],'convert/erpConvert','orderConvert/ErpConvertController::index');
$routes->match(['get','post'],'convert/erpB2B','orderConvert/ErpConvertController::erpB2B');
$routes->match(['get','post'],'convert/erp','orderConvert/ErpConvertController::erp');

//->고도몰 변환
$routes->match(['get','post'],'convert/godo','orderConvert/GodoConvertVenetmealv4Controller::index');
$routes->match(['get','post'],'convert/godo/venetmeal_v4','orderConvert/GodoConvertVenetmealv4Controller::godoConvertVenetmealVer4');
$routes->match(['get','post'],'convert/godo/eventout','orderConvert/EventProductOutConvertController::EventProductOutConvert');

//->쿠팡 변환
$routes->match(['get','post'],'convert/coupang','orderConvert/CoupangConvertController::index');
$routes->match(['get','post'],'convert/coupangResult','orderConvert/CoupangConvertController::coupangResult');

//->레몬트리 변환
$routes->match(['get','post'],'convert/lemonTree','orderConvert/LemonTreeConvertController::index');
$routes->match(['get','post'],'convert/lemonTreeResult','orderConvert/LemonTreeConvertController::lemonTreeResult');



//환불계산기
$routes->match(['get','post'],'refundCalc/refund','RefundCalcController::refund');
$routes->match(['get','post'],'refundCalc/refundPoint','RefundCalcController::refundPoint');


//직원관리
$routes->match(['get','post'],'employee','EmployeeController::index');
$routes->match(['get','post'],'employee/joinAgree','EmployeeController::joinAgree');

//고객관리
$routes->match(['get','post'],'customer/(:any)','CustomerController::index/$1');

//상품관리
$routes->match(['get','post'],'product','ProductManageController::index');
$routes->match(['get','post'],'product/loadSecond','ProductManageController::loadSecond');
$routes->match(['get','post'],'product/productInit','ProductManageController::productInit');
$routes->match(['get','post'],'product/addNewCate1','ProductManageController::addNewCate1');
$routes->match(['get','post'],'product/addNewCate2','ProductManageController::addNewCate2');
$routes->match(['get','post'],'product/insert','ProductManageController::insert');
$routes->match(['get','post'],'product/update','ProductManageController::update');
$routes->match(['get','post'],'product/delete','ProductManageController::delete');

//분유관리
$routes->match(['get','post'],'drymilk','DryMilkController::index');
$routes->match(['get','post'],'drymilk/loadSecond','DryMilkController::loadSecond');
$routes->match(['get','post'],'drymilk/productInit','DryMilkController::productInit');
$routes->match(['get','post'],'drymilk/addNewCate1','DryMilkController::addNewCate1');
$routes->match(['get','post'],'drymilk/addNewCate2','DryMilkController::addNewCate2');
$routes->match(['get','post'],'drymilk/update','DryMilkController::update');
$routes->match(['get','post'],'drymilk/delete','DryMilkController::delete');


//개인설정->정품출고
$routes->match(['get','post'],'genuine_out','GenuineController::index');
$routes->match(['get','post'],'genuine_out/search','GenuineController::search');
$routes->match(['get','post'],'genuine_out/resultSearch','GenuineController::resultSearch');



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
