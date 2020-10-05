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

Route::get('/','RouteController@welcome')->name('welcome');
Route::get('/home', 'RouteController@home')->name('home');
Route::get('/controlPanel', 'RouteController@controlPanel')->name('controlPanel');
Route::get('/account/{link}', 'RouteController@account')->name('account');
Route::get('/shop', 'RouteController@shop')->name('products.shop');
Route::get('/shopping-cart/empty', 'RouteController@shoppingCartRouter')->name('shopping-cart.router');
Route::get('/disabled', 'RouteController@disabled')->name('disabled');
Route::get('/payment', 'PaymentController@payment')->name('payment');
Route::get('/paymentRetry', 'PaymentController@retry')->name('payment.retry');
Route::get('/paymentHistory', 'RouteController@paymentHistory')->name('payment.history');

Route::resource('users', 'UserController');
Route::resource('products', 'ProductController');
Route::resource('shopping-cart', 'ShoppingCartController');

Route::get('/paymentResponse', 'PaymentController@paymentResponse')->name('paymentResponse');
