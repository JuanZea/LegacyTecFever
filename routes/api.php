<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ESTO PARA QUE? middleware('auth:api')->

Route::apiResource('products','Api\ProductController')->names([
    'store' => 'api.products.store',
    'index' => 'api.products.index',
    'destroy' => 'api.products.destroy',
    'update' => 'api.products.update',
    'show' => 'api.products.show',
]);

// Route::get('products', 'Api\ProductController@index')->name('api.products.index');
// Route::post('products', 'Api\ProductController@store')->name('api.products.create');
// Route::get('products/{product}', 'Api\ProductController@show')->name('api.products.show');
