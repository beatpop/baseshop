<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    Route::group(['namespace' => 'Products'], function (Router $router) {
        $router->resource('brands', BrandController::class);

    });
});
