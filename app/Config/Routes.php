<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\Home::index');
$routes->get('post/(:segment)', 'User\Post::index/$1');
$routes->get('category/(:any)', 'User\Category::index/$1');

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
    $routes->post('sub-categories/by-categories', 'Admin\SubCatagoriesController::getByCategories');

    $routes->get('news', 'Admin\PostController::news');
    $routes->get('all-news', 'Admin\PostController::index');
    $routes->post('news/create', 'Admin\PostController::createNewsPost');
    $routes->get('news/update/(:num)', 'Admin\PostController::updateNews/$1');
    $routes->post('news/update/(:num)', 'Admin\PostController::updateNewsPost/$1');
    $routes->post('news/update-status', 'Admin\PostController::updateStatus');
    $routes->post('news/delete/(:num)', 'Admin\PostController::deleteNewsPost/$1');

    $routes->get('user', 'Admin\UserController::user');
    $routes->get('all-users', 'Admin\UserController::index');
    $routes->post('user/create', 'Admin\UserController::createUser');
    $routes->post('user/update', 'Admin\UserController::updateUser');
    $routes->post('user/delete', 'Admin\UserController::deleteUser');
    $routes->post('user/restore', 'Admin\UserController::restoreUser');
    $routes->get('user/authorization/(:num)', 'Admin\AuthorizationController::index/$1');
});

$routes->set404Override(function () {
    return view('user/404.php', ['pageTitle' => 'Error']);
});
