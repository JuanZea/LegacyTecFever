<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

// Generic Routes
Route::get('/','RouteController@welcome')->name('welcome');
Route::get('/home', 'RouteController@home')->name('home');
Route::get('/shop', 'RouteController@shop')->name('shop');
Route::get('/account', 'RouteController@account')->name('account');
Route::get('/disabled', 'RouteController@disabled')->name('disabled');
Route::get('/control_panel', 'RouteController@control_panel')->name('control_panel');

// Users Routes
Route::resource('users', 'UserController');

// Products Routes
Route::post('products/import', 'ProductController@import')->name('products.import');
Route::resource('products', 'ProductController');

// Payment Routes
Route::get('/payment/Response', 'PaymentController@response')->name('payment.response');
Route::get('/payment/History', 'PaymentController@history')->name('payment.history');
Route::get('/payment/Retry', 'PaymentController@retry')->name('payment.retry');
Route::post('/payment', 'PaymentController@payment')->name('payment');


// Reports Routes
Route::get('reports/specifics', 'ReportController@specifics')->name('reports.specifics');
Route::get('reports/download/{export}', 'ReportController@download')->name('reports.download');
Route::get('reports', 'ReportController@summary')->name('reports.summary');

// Exports Routes
Route::post('exports', 'ExportController@export')->name('export');
Route::get('reports/exports', 'ExportController@index')->name('exports.index');
Route::delete('exports/{export}', 'ExportController@destroy')->name('exports.destroy');

// Shopping Carts Routes
Route::patch('shoppingCarts/clean/{shoppingCart}', 'ShoppingCartController@clean')->name('shoppingCarts.clean');
Route::resource('shoppingCarts', 'ShoppingCartController');

