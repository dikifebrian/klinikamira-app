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
Route::get('/login', '\App\Http\Controllers\LoginController@login')->name('login');
Route::post('/postlogin', '\App\Http\Controllers\LoginController@postlogin')->name('postlogin');
Route::get('/logout', '\App\Http\Controllers\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'ceklevel:manajer,dokter,kasir,terapis']], function () {
    Route::get('/dashboard', '\App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
    Route::resource('/pasien', '\App\Http\Controllers\PasienController');
    Route::resource('/tindakan', '\App\Http\Controllers\TindakanController');
    Route::resource('/facial', '\App\Http\Controllers\FacialController');
    Route::resource('/produk', '\App\Http\Controllers\ProdukController');
    Route::resource('/rekammedis', '\App\Http\Controllers\RekammedisController');
    Route::resource('/pengguna', '\App\Http\Controllers\PenggunaController');
    Route::get('/tglprint', '\App\Http\Controllers\RekammedisController@tglprint');

    Route::post('/pasien-filter', '\App\Http\Controllers\PasienFilter');
    Route::post('/rekammedis-filter', '\App\Http\Controllers\RekamMedisFilter');

    Route::put('/rekammedis-status', '\App\Http\Controllers\RekammedisController@updateStatus')->name('rekammedis.put');
});
