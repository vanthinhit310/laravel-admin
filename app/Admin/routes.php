<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->get('users/demo/page', 'UserController@demo');
    $router->resource('posts', PostController::class);

    //Fileupload
    $router->post('/file-upload', 'FileuploadController@index')->middleware('optimizeImages');

    // translation manager
    $router->get('translations', 'TranslationController@index');
});
