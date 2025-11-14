<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Set default & keamanan
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('CvController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); 

// Halaman utama CV
$routes->get('/', 'CvController::index');
$routes->get('cv', 'CvController::index');

// Tes koneksi DB (hanya kalau controllernya ada)
if (class_exists(\App\Controllers\TestDB::class)) {
    $routes->get('testdb', 'TestDB::index');
}
