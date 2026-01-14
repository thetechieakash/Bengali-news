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

});

$routes->set404Override(function () {
    return view('user/404.php',['pageTitle'=>'Error']);
});