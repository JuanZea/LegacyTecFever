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
Route::get('/account', 'RouteController@account')->name('account');
Route::get('/shop', 'RouteController@shop')->name('shop');
Route::get('/disabled', 'RouteController@disabled')->name('disabled');


Route::resource('users', 'UserController');


Route::resource('products', 'ProductController');


Route::get('/payment', 'PaymentController@payment')->name('payment');
Route::get('/payment/Retry', 'PaymentController@retry')->name('payment.retry');
Route::get('/payment/History', 'PaymentController@history')->name('payment.history');
Route::get('/payment/Response', 'PaymentController@response')->name('payment.response');


Route::resource('shoppingCarts', 'ShoppingCartController');
Route::patch('shoppingCarts/clean/{shoppingCart}', 'ShoppingCartController@clean')->name('shoppingCarts.clean');


