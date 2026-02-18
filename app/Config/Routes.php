<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\Home::index');
$routes->get('news/(:segment)', 'User\Post::index/$1');
$routes->get('category/(:segment)', 'User\Category::index/$1');
$routes->get('category/(:segment)/sub-category/(:segment)', 'User\SubCategory::index/$1/$2');
$routes->post('comment', 'User\PostComment::store');
$routes->get('tag/(:segment)', 'User\Tag::index/$1');
$routes->get('search', 'User\Search::index');


service('auth')->routes($routes);

$routes->group('admin', ['filter' => 'group:superadmin,admin,author'], function ($routes) {

    /*
    |--------------------------------------------------------------------------
    | Admin-only routes
    |--------------------------------------------------------------------------
    */
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->group('', ['filter' => 'group:admin,superadmin'], function ($routes) {

        // Categories
        $routes->get('categories', 'Admin\CategoriesController::index');
        $routes->post('categories', 'Admin\CategoriesController::createCategory');
        $routes->post('category/update', 'Admin\CategoriesController::updateCategory');
        $routes->post('category/update-active', 'Admin\CategoriesController::updateActive');
        $routes->post('category/update-status', 'Admin\CategoriesController::updateStatus');
        $routes->post('category/delete', 'Admin\CategoriesController::deleteCategory');

        // Sub-categories
        $routes->get('sub-categories', 'Admin\SubCatagoriesController::index');
        $routes->post('sub-categories', 'Admin\SubCatagoriesController::createSubCategory');
        $routes->post('sub-categories/update', 'Admin\SubCatagoriesController::updateSubCategory');
        $routes->post('sub-categories/update-active', 'Admin\SubCatagoriesController::updateActive');
        $routes->post('sub-categories/update-status', 'Admin\SubCatagoriesController::updateStatus');
        $routes->post('sub-categories/delete', 'Admin\SubCatagoriesController::deleteSubCategory');
        $routes->post('sub-categories/by-categories', 'Admin\SubCatagoriesController::getByCategories');

        // Comments
        $routes->get('approved-comments', 'Admin\CommentsController::approved');
        $routes->get('pending-comments', 'Admin\CommentsController::pending');
        $routes->post('comments/approve', 'Admin\CommentsController::approve');
        $routes->post('comments/reply', 'Admin\CommentsController::store');
        $routes->post('comments/unpublish', 'Admin\CommentsController::unpublish');
        $routes->post('comments/delete', 'Admin\CommentsController::delete');

        $routes->get('tags', 'Admin\TagsController::index');
        $routes->post('tag/create', 'Admin\TagsController::createTag');
        $routes->post('tag/update', 'Admin\TagsController::updateTag');
        $routes->post('tag/delete', 'Admin\TagsController::deleteTag');

        $routes->get('media', 'Admin\MediaController::index');
        $routes->post('upload-media', 'Admin\MediaController::upload');
        $routes->delete('delete-media/(:num)', 'Admin\MediaController::delete/$1');

        $routes->get('author', 'Admin\SubAuthorController::index');
        $routes->get('author-get/(:num)', 'Admin\SubAuthorController::getAuthor/$1');
        $routes->post('author-create', 'Admin\SubAuthorController::store');
        $routes->post('author-update/(:num)', 'Admin\SubAuthorController::update/$1');
        $routes->post('author-delete/(:num)', 'Admin\SubAuthorController::delete/$1');
    });

    /*
    |--------------------------------------------------------------------------
    | Author routes (author + admin + superadmin)
    |--------------------------------------------------------------------------
    */
    $routes->group('', ['filter' => 'group:author,admin,superadmin'], function ($routes) {
        $routes->get('all-news', 'Admin\Post\ViewsController::index');
        $routes->get('create-news', 'Admin\Post\ViewsController::news');
        $routes->get('news-preview', 'Admin\Post\ViewsController::index');
        $routes->post('news/create', 'Admin\Post\CreatePostController::createPost');
        $routes->get('news/update/(:num)', 'Admin\Post\ViewsController::updateNews/$1');
        $routes->post('news/update/(:num)', 'Admin\Post\UpdatePostController::updatePost/$1');
        $routes->post('news/update-status', 'Admin\Post\TogglersPost::updateStatus');
        $routes->post('news/delete/(:num)', 'Admin\Post\DeletePostController::deletePost/$1');
    });

    /*
    |--------------------------------------------------------------------------
    | Superadmin / Admin user management
    |--------------------------------------------------------------------------
    */
    $routes->group('', ['filter' => 'group:superadmin'], function ($routes) {
        $routes->get('user', 'Admin\UserController::user');
        $routes->get('all-users', 'Admin\UserController::index');
        $routes->post('user/create', 'Admin\UserController::createUser');
        $routes->post('user/update', 'Admin\UserController::updateUser');
        $routes->post('user/delete', 'Admin\UserController::deleteUser');
        $routes->post('user/restore', 'Admin\UserController::restoreUser');
    });

    $routes->group('api', function ($routes) {
        $routes->get('get-comment', 'Admin\CommentsController::getPostComment');
        $routes->get('get-reply', 'Admin\CommentsController::getReply');
        $routes->get('get-media', 'Admin\MediaController::getMedia');
    });
});


$routes->set404Override(function () {
    return view('user/404.php', ['pageTitle' => 'Error']);
});
