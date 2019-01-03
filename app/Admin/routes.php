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
        $router->resource('wx/users', UserController::class);
        $router->resource('wx/useraddresses', UserAddressController::class);
        $router->resource('brands', BrandController::class);
        $router->resource('productcategories', ProductCategoryController::class);
        $router->resource('products', ProductController::class);
        $router->resource('productskus', ProductSkuController::class);
    });
});
