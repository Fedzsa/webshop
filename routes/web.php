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
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users')->middleware('can:viewAny,App\Models\User');

Route::resource('categories', 'CategoryController')->except(['show']);
Route::get('/categories/{category}/delete', 'CategoryController@delete')->name('categories.delete');
Route::put('/categories/{category}/restore', 'CategoryController@restore')->name('categories.restore');

Route::resource('specifications', 'SpecificationController')->except(['show']);
Route::get('/specifications/{specification}/delete', 'SpecificationController@delete')->name('specifications.delete');
Route::put('/specifications/{specification}/restore', 'SpecificationController@restore')->name('specifications.restore');

Route::get('/products', 'ProductController@index')->name('products')->middleware('can:viewAny,App\Models\Product');
Route::get('/products/create', 'ProductController@create')->name('create-product')->middleware('can:viewAny,App\Models\Product');
Route::get('/products/{id}', 'ProductController@show')->name('show-product');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('edit-product');
Route::post('/products', 'ProductController@store')->name('store-product')->middleware('can:create,App\Models\Product');
Route::post('/products/{id}', 'ProductController@update')->name('update-product');
