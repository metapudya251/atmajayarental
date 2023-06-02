<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\AsetController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Pegawai
Route::get('pegawai', 'Api\PegawaiController@index' );
Route::get('pegawai/{id}', 'Api\PegawaiController@show' );
Route::post('pegawai', 'Api\PegawaiController@store' );
Route::put('pegawai/{id}', 'Api\PegawaiController@update' );
Route::delete('pegawai/{id}', 'Api\PegawaiController@destroy' );
//Driver
Route::get('driver', 'Api\DriverController@index' );
Route::get('driver/{id}', 'Api\DriverController@show' );
Route::post('driver', 'Api\DriverController@store' );
Route::put('driver/{id}', 'Api\DriverController@update' );
Route::delete('driver/{id}', 'Api\DriverController@destroy' );
//Customer
Route::get('customer', 'Api\CustomerController@index' );
Route::get('logincust/{username}/{password}', 'Api\CustomerController@login' );
Route::get('customer/{id}', 'Api\CustomerController@show' );
Route::post('customer', 'Api\CustomerController@store' );
Route::put('customer/{id}', 'Api\CustomerController@update' );
Route::delete('customer/{id}', 'Api\CustomerController@destroy' );
//Promo
Route::get('promo', 'Api\PromoController@index' );
Route::get('promoAktif', 'Api\PromoController@showAktif' );
Route::get('promo/{id}', 'Api\PromoController@show' );
Route::delete('promo/{id}', 'Api\PromoController@destroy' );
//Aset
Route::get('aset', 'Api\AsetController@index' );
Route::get('aset/{id}', 'Api\AsetController@show' );
Route::delete('aset/{id}', 'Api\AsetController@destroy' );
//Transaksi
Route::get('transaksi', 'Api\TransaksiController@index' );
Route::get('transaksiHistory', 'Api\TransaksiController@history');
Route::get('transaksiHistoryDrv', 'Api\TransaksiController@historyDrv');
Route::get('transaksiMobil', 'Api\TransaksiController@incomeMobil');
Route::get('transaksiCust', 'Api\TransaksiController@incomeCust');
Route::get('transaksiTop5Driver', 'Api\TransaksiController@top5driver');
Route::get('transaksiTop5Cust', 'Api\TransaksiController@top5cust');
Route::get('transaksi/{id}', 'Api\TransaksiController@show' );
Route::delete('transaksi/{id}', 'Api\TransaksiController@destroy' );