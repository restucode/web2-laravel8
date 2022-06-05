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


Route::get('/dashboard', 'HomeController@index');

Route::group(['middleware' => 'admin'], function() {

	// Route Guru
	Route::get('/guru', 'GuruController@index')->name('guru');
	Route::get('/guru/detail/{id_guru}', 'GuruController@detail');
	Route::get('/guru/add', 'GuruController@add');
	Route::post('guru/insert', 'GuruController@insert');
	Route::get('/guru/edit/{id_guru}', 'GuruController@edit');
	Route::post('/guru/update/{id_guru}', 'GuruController@update');
	Route::get('/guru/delete/{id_guru}', 'GuruController@delete');

	// Route Siswa
	Route::get('/siswa', 'SiswaController@index');
});


Route::group(['middleware' => 'user'], function() {
	// Route User
	Route::get('/user', 'UserController@index');
});

Route::group(['middleware' => 'koperasi'], function() {
	// Route Koperasi
	Route::get('/koperasi', 'KoperasiController@index');
	Route::get('/koperasi/print', 'KoperasiController@print');
	Route::get('/koperasi/printpdf', 'KoperasiController@printpdf');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
