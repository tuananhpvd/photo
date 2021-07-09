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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hoadon/create', 'App\Http\Controllers\Hoadon\HoadonController@create')->name('hoadon_create');
Route::PATCH('/hoadon/store', 'App\Http\Controllers\Hoadon\HoadonController@store')->name('hoadon_store');
Route::get('/hoadon/xem', 'App\Http\Controllers\Hoadon\HoadonController@index')->name('hoadon_xem');
Route::get('/hoadon/edit/{id}', 'App\Http\Controllers\Hoadon\HoadonController@edit')->name('hoadon_edit');
Route::PATCH('/hoadon/update/{id}', 'App\Http\Controllers\Hoadon\HoadonController@update')->name('hoadon_update');
Route::DELETE('/hoadon/delete/{id}', 'App\Http\Controllers\Hoadon\HoadonController@destroy')->name('hoadon_xoa');
Route::DELETE('/hoadon/xoahet', 'App\Http\Controllers\Hoadon\HoadonController@xoahet')->name('hoadon_xoahet');

Route::get('/hoadon/xuat/{type}', 'App\Http\Controllers\XuatHoaDonController@export');

Route::get('/hoadon/search', 'App\Http\Controllers\Hoadon\HoadonController@search')->name('hoadon_search');
Route::get('/hoadon/search/lop/{type}', 'App\Http\Controllers\XuatHoaDonLopController@export');
Route::get('/hoadon/search/khoi/{type}', 'App\Http\Controllers\XuatHoaDonLopController@exportkhoi');
Route::get('/hoadon/search/gvcn/{type}', 'App\Http\Controllers\XuatHoaDonLopController@gvcn');

Route::get('/lop/create', 'App\Http\Controllers\Hoadon\LopController@create')->name('lop_create');
Route::post('/lop/store', 'App\Http\Controllers\Hoadon\LopController@store')->name('lop_store');
Route::get('/lop/xem', 'App\Http\Controllers\Hoadon\LopController@index')->name('lop_xem');
Route::get('/lop/edit/{id}', 'App\Http\Controllers\Hoadon\LopController@edit')->name('lop_edit');
Route::PATCH('/lop/update/{id}', 'App\Http\Controllers\Hoadon\LopController@update')->name('lop_update');
Route::DELETE('/lop/delete/{id}', 'App\Http\Controllers\Hoadon\LopController@destroy')->name('lop_xoa');

Route::get('/lop/export', 'App\Http\Controllers\XuatLopController@export')->name('export_lop');

Route::get('/giay/create', 'App\Http\Controllers\Hoadon\GiayController@create')->name('giay_create');
Route::post('/giay/store', 'App\Http\Controllers\Hoadon\GiayController@store')->name('giay_store');
Route::get('/giay/xem', 'App\Http\Controllers\Hoadon\GiayController@index')->name('giay_xem');
Route::get('/giay/edit/{id}', 'App\Http\Controllers\Hoadon\GiayController@edit')->name('giay_edit');
Route::PATCH('/giay/update/{id}', 'App\Http\Controllers\Hoadon\GiayController@update')->name('giay_update');
Route::DELETE('/giay/delete/{id}', 'App\Http\Controllers\Hoadon\GiayController@destroy')->name('giay_xoa');

Route::get('/giay/export', 'App\Http\Controllers\XuatGiayController@export')->name('export_giay');
