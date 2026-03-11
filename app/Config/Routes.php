<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\Home::index');
$routes->get('news/(:segment)', 'User\Post::index/$1');
$routes->get('category/(:segment)', 'User\Category::index/$1');
$routes->get('category/(:segment)/(:segment)', 'User\SubCategory::index/$1/$2');
$routes->get('category/(:segment)/(:segment)/(:segment)', 'User\ChildCategory::index/$1/$2/$3');
$routes->post('comment', 'User\PostComment::store');
$routes->get('tag/(:segment)', 'User\Tag::index/$1');
$routes->get('search', 'User\Search::index');


service('auth')->routes($routes);

$routes->group('admin', ['filter' => 'group:superadmin,admin,author'], function ($routes) {

    $routes->get('/', 'Admin\DashboardController::index', ['filter' => 'permission:dashboard.view']);

    // Categories
    $routes->get('categories', 'Admin\CategoriesController::index', ['filter' => 'permission:categories.view']);
    $routes->post('categories', 'Admin\CategoriesController::createCategory', ['filter' => 'permission:categories.create']);
    $routes->post('category/update', 'Admin\CategoriesController::updateCategory', ['filter' => 'permission:categories.update']);
    $routes->post('category/update-active', 'Admin\CategoriesController::updateActive', ['filter' => 'permission:categories.update']);
    $routes->post('category/update-status', 'Admin\CategoriesController::updateStatus', ['filter' => 'permission:categories.update']);
    $routes->post('category/delete', 'Admin\CategoriesController::deleteCategory', ['filter' => 'permission:categories.delete']);

    // Sub-categories
    $routes->get('sub-categories', 'Admin\SubCatagoriesController::index', ['filter' => 'permission:sub_categories.view']);
    $routes->post('sub-categories', 'Admin\SubCatagoriesController::createSubCategory', ['filter' => 'permission:sub_categories.create']);
    $routes->post('sub-categories/update', 'Admin\SubCatagoriesController::updateSubCategory', ['filter' => 'permission:sub_categories.update']);
    $routes->post('sub-categories/update-active', 'Admin\SubCatagoriesController::updateActive', ['filter' => 'permission:sub_categories.update']);
    $routes->post('sub-categories/update-status', 'Admin\SubCatagoriesController::updateStatus', ['filter' => 'permission:sub_categories.update']);
    $routes->post('sub-categories/delete', 'Admin\SubCatagoriesController::deleteSubCategory', ['filter' => 'permission:sub_categories.delete']);
    $routes->post('sub-categories/by-categories', 'Admin\SubCatagoriesController::getByCategories');

    // Child-categories
    $routes->get('child-categories', 'Admin\ChildCatagoriesController::index', ['filter' => 'permission:child_categories.view']);
    $routes->post('child-categories', 'Admin\ChildCatagoriesController::createChildCategory', ['filter' => 'permission:child_categories.create']);
    $routes->post('child-categories/update', 'Admin\ChildCatagoriesController::updateChildCategory', ['filter' => 'permission:child_categories.update']);
    $routes->post('child-categories/delete', 'Admin\ChildCatagoriesController::deleteChildCategory', ['filter' => 'permission:child_categories.delete']);
    $routes->post('child-categories/by-subcategories', 'Admin\ChildCatagoriesController::getChildren');


    // Comments
    $routes->get('approved-comments', 'Admin\CommentsController::approved', ['filter' => 'permission:comments.view']);
    $routes->get('pending-comments', 'Admin\CommentsController::pending', ['filter' => 'permission:comments.view']);
    $routes->post('comments/approve', 'Admin\CommentsController::approve', ['filter' => 'permission:comments.approve']);
    $routes->post('comments/reply', 'Admin\CommentsController::store', ['filter' => 'permission:comments.reply']);
    $routes->post('comments/unpublish', 'Admin\CommentsController::unpublish', ['filter' => 'permission:comments.unpublish']);
    $routes->post('comments/delete', 'Admin\CommentsController::delete', ['filter' => 'permission:comments.delete']);

    $routes->get('tags', 'Admin\TagsController::index', ['filter' => 'permission:tags.view']);
    $routes->post('tag/create', 'Admin\TagsController::createTag', ['filter' => 'permission:tags.create']);
    $routes->post('tag/update', 'Admin\TagsController::updateTag', ['filter' => 'permission:tags.update']);
    $routes->post('tag/delete', 'Admin\TagsController::deleteTag', ['filter' => 'permission:tags.delete']);

    $routes->get('media', 'Admin\MediaController::index', ['filter' => 'permission:media.view']);
    $routes->post('upload-media', 'Admin\MediaController::upload', ['filter' => 'permission:media.create']);
    $routes->delete('delete-media/(:num)', 'Admin\MediaController::delete/$1', ['filter' => 'permission:media.delete']);

    $routes->get('documents', 'Admin\DocumentController::index', ['filter' => 'permission:documents.view']);
    $routes->post('document/upload', 'Admin\DocumentController::upload', ['filter' => 'permission:documents.create']);
    $routes->delete('delete-document/(:num)', 'Admin\DocumentController::delete/$1', ['filter' => 'permission:documents.delete']);


    $routes->get('author', 'Admin\SubAuthorController::index', ['filter' => 'permission:author.view']);
    $routes->get('author-get/(:num)', 'Admin\SubAuthorController::getAuthor/$1');
    $routes->post('author-create', 'Admin\SubAuthorController::store', ['filter' => 'permission:author.create']);
    $routes->post('author-update/(:num)', 'Admin\SubAuthorController::update/$1', ['filter' => 'permission:author.update']);
    $routes->post('author-delete/(:num)', 'Admin\SubAuthorController::delete/$1', ['filter' => 'permission:author.delete']);

    $routes->get('ads', 'Admin\AdsController::index', ['filter' => 'permission:ads.view']);
    $routes->get('ads/(:num)', 'Admin\AdsController::getAd/$1');
    $routes->post('ads/store', 'Admin\AdsController::store', ['filter' => 'permission:ads.create']);
    $routes->post('ads/toggle-status', 'Admin\AdsController::toggleStatus', ['filter' => 'permission:ads.status']);
    $routes->post('ads/update/(:num)', 'Admin\AdsController::update/$1', ['filter' => 'permission:ads.update']);
    $routes->post('ads/delete', 'Admin\AdsController::delete', ['filter' => 'permission:ads.delete']);

    $routes->get('published-news', 'Admin\Post\ViewsController::index', ['filter' => 'permission:news.view']);
    $routes->get('draft-news', 'Admin\Post\ViewsController::draft', ['filter' => 'permission:news.view']);

    $routes->get('news-preview', 'Admin\Post\ViewsController::index', ['filter' => 'permission:news.view']);

    $routes->get('create-news', 'Admin\Post\ViewsController::news', ['filter' => 'permission:news.create']);
    $routes->post('news/create', 'Admin\Post\CreatePostController::createPost', ['filter' => 'permission:news.create']);

    $routes->get('news/update/(:num)', 'Admin\Post\ViewsController::updateNews/$1', ['filter' => 'permission:news.update']);
    $routes->post('news/update/(:num)', 'Admin\Post\UpdatePostController::updatePost/$1', ['filter' => 'permission:news.update']);

    $routes->post('news/update-status', 'Admin\Post\TogglersPost::updateStatus', ['filter' => 'permission:news.status']);
    $routes->post('news/delete/(:num)', 'Admin\Post\DeletePostController::deletePost/$1', ['filter' => 'permission:news.delete']);

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
        $routes->get('user/permission/(:num)', 'Admin\UserController::permission/$1');
        $routes->post('user/permission/(:num)', 'Admin\UserController::setPermission/$1');
    });

    $routes->group('api', function ($routes) {
        $routes->get('get-comment', 'Admin\CommentsController::getPostComment');
        $routes->get('get-reply', 'Admin\CommentsController::getReply');
        $routes->get('get-media', 'Admin\MediaController::getMedia');
        $routes->get('get-documents', 'Admin\DocumentController::getDocuments');
    });
});


$routes->set404Override(function () {
    return view('user/404.php', ['pageTitle' => 'Error']);
});
