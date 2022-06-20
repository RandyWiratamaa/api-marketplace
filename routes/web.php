<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');

    $router->group(['middleware' => 'auth'], function () use ($router){
        Route::post('logout', 'AuthController@logout');
        Route::get('user-profile', 'AuthController@me');
        Route::get('/category', 'Admin\CategoryController@index');
        Route::post('/category', 'Admin\CategoryController@store');
        Route::get('/product', 'Admin\ProductController@index');
        Route::post('/product', 'Admin\ProductController@store');
        Route::get('/variant', 'Admin\VariantController@index');
        Route::post('/variant', 'Admin\VariantController@store');

        Route::group(['prefix' => 'super-user'], function ($router) {
            Route::get('/roles', 'SuperUser\RoleController@index');
            Route::post('/roles', 'SuperUser\RoleController@store');
        });
    });
});
