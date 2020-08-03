<?php

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
Route::get('/shop', 'RouteController@shop')->name('products.shop');

Route::resource('users', 'UserController');
Route::resource('products', 'ProductController');
