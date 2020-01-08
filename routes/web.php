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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('categories')->group(function () {
    Route::get('', 'CategoryController@index')->name('categories.list');
    Route::post('', 'CategoryController@store')->name('categories.store');
    Route::get('create', 'CategoryController@create')->name('categories.create');
    Route::get('{category}', 'CategoryController@show')->name('categories.show');
    Route::get('{category}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('{category}', 'CategoryController@update')->name('categories.update');
    Route::delete('{category}/delete', 'CategoryController@destroy')->name('categories.destroy');
});

Route::prefix('products')->group(function () {
    Route::get('', 'ProductController@index')->name('products.list');
    Route::post('', 'ProductController@store')->name('products.store');
    Route::get('create', 'ProductController@create')->name('products.create');
    Route::get('{product}', 'ProductController@show')->name('products.show');
    Route::get('{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('{product}', 'ProductController@update')->name('products.update');
    Route::delete('{product}/delete', 'ProductController@destroy')->name('products.destroy');
});
