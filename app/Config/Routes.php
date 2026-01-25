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
    $routes->get('categories', 'Admin\CategoriesController::index');
    $routes->post('categories', 'Admin\CategoriesController::createCategory');
    $routes->post('category/update', 'Admin\CategoriesController::updateCategory');
    $routes->post('category/update-active', 'Admin\CategoriesController::updateActive');
    $routes->post('category/update-status', 'Admin\CategoriesController::updateStatus');
    $routes->post('category/delete', 'Admin\CategoriesController::deleteCategory');

    $routes->get('sub-categories', 'Admin\SubCatagoriesController::index');
    $routes->post('sub-categories', 'Admin\SubCatagoriesController::createSubCategory');
    $routes->post('sub-categories/update', 'Admin\SubCatagoriesController::updateSubCategory');
    $routes->post('sub-categories/update-active', 'Admin\SubCatagoriesController::updateActive');
    $routes->post('sub-categories/update-status', 'Admin\SubCatagoriesController::updateStatus');
    $routes->post('sub-categories/delete', 'Admin\SubCatagoriesController::deleteSubCategory');
});

$routes->set404Override(function () {
    return view('user/404.php', ['pageTitle' => 'Error']);
});
