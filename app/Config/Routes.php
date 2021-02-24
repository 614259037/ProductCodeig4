<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Product');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);



$routes->get('/products', 'Product::index'); //เรียกใช้ฟังก์ชั่น index ที่ path /product
$routes->get('/products/(:num)', 'Product::getProduct/$1'); //เรียกใช้ฟังก์ชั่นgetProduct โดยรับparamiter ตัวเเรก ที่path /products/(:num) เป็นid
$routes->post('/products', 'Product::create'); ///เรียกใช้ฟังก์ชั่น create โดยใช้method post 
$routes->put('/products/(:num)', 'Product::update/$1'); //เรียกใช้ฟังก์ชั่น update โดย update ที่ paramiter ตัวเเรกที่ส่งมาเป็นid
$routes->delete('/products/(:num)', 'Product::delete/$1'); //เรียกใช้ฟังก์ชั่น delete โดย delete ที่ paramiter ตัวเเรกที่ส่งมา




if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
