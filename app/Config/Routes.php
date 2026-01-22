<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\Home::index');
$routes->get('post', 'User\Post::index');

service('auth')->routes($routes);

$routes->group('admin', ['filter' => 'group:superadmin,admin,developer'], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('catagories', 'Admin\CatagoriesController::index');
    $routes->post('catagories', 'Admin\CatagoriesController::createCatagory');
    $routes->post('catagory/update', 'Admin\CatagoriesController::updateCatagory');
    $routes->post('category/update-active', 'Admin\CatagoriesController::updateActive');
    $routes->post('category/update-status', 'Admin\CatagoriesController::updateStatus');
    $routes->post('category/delete', 'Admin\CatagoriesController::deleteCatagory');
    $routes->post('sub-catagories', 'Admin\CatagoriesController::createSubCatagory');
});

$routes->set404Override(function () {
    return view('user/404.php',['pageTitle'=>'Error']);
});