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

Route::get('/', function() {
    return redirect(route('login'));
});
Auth::routes();
	Route::resource('/hotel', 'HotelController')->except([
    'create', 'show']);
    Route::get('/hotel/cari', 'HotelController@cari')->name('hotel.cari');
	Route::resource('/destinasi', 'DestinationController');
	Route::get('/destinasi/cari', 'DestinationController@show')->name('destinasi.cari');
	Route::resource('/riwayat', 'RiwayatController');
	Route::get('/riwayat/show', 'RiwayatController@show')->name('riwayat.show');
	Route::get('/home', 'HomeController@index')->name('home');
	
Route::resource('/transaksi', 'TransactionController');
Route::get('destinasi/{id}/harga', 'DestinationController@harga');
Route::get('hotel/{id}/harga', 'HotelController@harga');
Route::resource('/role', 'RoleController')->except(['create', 'show', 'edit', 'update']);

Route::resource('/users', 'UserController')->except(['show']);
Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
Route::get('/users/role_permission', 'UserController@rolePermissions')->name('users.roles_permission');