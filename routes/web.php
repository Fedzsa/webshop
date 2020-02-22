<?php

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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users')->middleware('can:viewAny,App\Models\User');

Route::get('/products', 'ProductController@index')->name('products')->middleware('can:viewAny,App\Models\Product');
Route::get('/products/create', 'ProductController@create')->name('create-product')->middleware('can:viewAny,App\Models\Product');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('edit-product');
Route::post('/products', 'ProductController@store')->name('store-product')->middleware('can:create,App\Models\Product');
Route::post('/products/{id}', 'ProductController@update')->name('update-product');