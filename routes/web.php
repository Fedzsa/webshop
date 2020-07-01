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

Route::resource('products', 'ProductController');
Route::put('/products/{product}/restore', 'ProductController@restore');

Route::resource('products.specifications', 'ProductSpecificationController')->except(['show']);
Route::put('/products/{product}/specifications/{specification}/restore', 'ProductSpecificationController@restore')->name('products.specifications.restore');
Route::get('/products/{product}/images', 'ProductController@images')->name('products.images');
Route::post('/products/{product}/images', 'ProductController@storeImage')->name('products.images.store');
Route::delete('/products/{product}/images/{file}', 'ProductController@destroyImage')->name('products.images.destroy');
Route::post('/products/{product}/comments', 'CommentController@store')->name('products.comments.store');
Route::put('/products/{product}/comments/{comment}', 'CommentController@update')->name('products.comments.update');

Route::get('/dashboard', 'DashboardController')->name('dashboard.index');

Route::get('/notifications/unread-number', 'NotificationController@unreadNumber')->name('notifications.unread_number');
Route::put('/notifications/{id}', 'NotificationController@update')->name('notifications.update');