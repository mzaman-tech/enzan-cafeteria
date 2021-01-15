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


Route::post('set-locale', 'Web\SetLocaleController');
Route::get('/', function(){
    return redirect('/login');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
	Route::get('dashboard', 'Web\DashboardController@index')->name('dashboard');
	Route::resource('items', 'Web\ItemController')->except('index');

	Route::get('orders', 'Web\OrderController@index');
	Route::post('orders/{id}', 'Web\OrderController@confirmDelivery');

});
