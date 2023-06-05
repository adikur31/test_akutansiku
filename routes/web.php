<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Beranda;
use App\Http\Controllers\Staff;
use App\Http\Controllers\Guest;
use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

// Route::get('login', [LoginController::class, 'index'])->name('login');
//verfikasi hak ases user
Route::get('/', [LayoutController::class,'index'])->middleware('auth');
Route::get('/home', [LayoutController::class,'index'])->middleware('auth');
Route::get('/data', [LayoutController::class,'index'])->middleware('auth');



Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout','logout');

});

    Route::group(['middleware'=> ['auth']],function(){
        Route::group(['middleware'=> ['cekUserLogin:1']],function(){
            Route::resource('beranda', Beranda::class);

        });

        Route::group(['middleware'=> ['cekUserLogin:2']],function(){
            Route::resource('staff', Staff::class);
          });
          Route::group(['middleware'=> ['cekUserLogin:3']],function(){
            Route::resource('guest', Guest::class);
          });

        Route::resource('barang', BarangController::class);
        Route::get('/barang/tambah',BarangController::class);
        Route::get('/barang','BarangController@index');
        Route::post('/barang/store','BarangController@store');
    });
