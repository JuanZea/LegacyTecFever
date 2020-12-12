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
Route::get('/disabled', 'RouteController@disabled')->name('disabled');
Route::get('/control_panel', 'RouteController@control_panel')->name('control_panel');

// Emails Routes
Route::post('/information_email/{user}', 'EmailController@information')->name('information_email');

// Account Routes
Route::get('/account', 'RouteController@account')->name('account');
Route::get('/account/shopping_history', 'RouteController@shopping_history')->name('account.shopping_history');

// Users Routes
Route::put('users/update_roles/{user}', 'UserController@update_roles')->name('users.update_roles');
Route::resource('users', 'UserController');

// Products Routes
Route::resource('products', 'ProductController');

// Payment Routes
Route::get('/payment/Response', 'PaymentController@response')->name('payment.response');
Route::get('/payment/History', 'PaymentController@history')->name('payment.history');
Route::get('/payment/Retry', 'PaymentController@retry')->name('payment.retry');
Route::post('/payment', 'PaymentController@payment')->name('payment');


// Reports Routes
Route::post('reports/generate', 'ReportController@generate')->name('reports.generate');
Route::get('reports/download/{report}', 'ReportController@download')->name('reports.download');
Route::delete('reports/delete/{report}', 'ReportController@destroy')->name('reports.destroy');
Route::get('reports', 'ReportController@summary')->name('reports.summary');

// Exports Routes
Route::get('exports/exports', 'ExportController@index')->name('exports.index');
Route::get('exports/download/{export}', 'ExportController@download')->name('exports.download');
Route::delete('exports/{export}', 'ExportController@destroy')->name('exports.destroy');
Route::post('exports', 'ExportController@export')->name('export');

// Imports Routes
Route::post('import', 'ImportController@import')->name('import');

// Shopping Carts Routes
Route::patch('shoppingCarts/clean/{shoppingCart}', 'ShoppingCartController@clean')->name('shoppingCarts.clean');
Route::resource('shoppingCarts', 'ShoppingCartController');

