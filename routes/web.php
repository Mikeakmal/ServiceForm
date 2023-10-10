<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kendaraanController;
use App\Http\Controllers\peralatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengerjaanController;

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
    return view('frontend.dashboard');
});
//dashboard
Route::get('/dashboard', [dashboardController::class, 'index']);

//Kendaraan
Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::get('/formkendaraan/{id_kendaraan}', [KendaraanController::class, 'edit']);
Route::post('/addkendaraan', [KendaraanController::class, 'store']);
Route::get('/kendaraan/{id_kendaraan}', [KendaraanController::class, 'delete']);

//pengerjaan
Route::get('/pengerjaan', [PengerjaanController::class, 'index']);
Route::get('/formkendaraan/{id_kendaraan}', [PengerjaanController::class, 'edit']);
Route::get('/kendaraan/{id_kendaraan}', [PengerjaanController::class, 'delete']);



//Barang
Route::get('/formbarang', [barangController::class, 'index']);
Route::get('/tblbarang', [barangController::class, 'create']);
Route::post('/addbarang', [barangController::class, 'store']);
Route::get('/formbarang/{id_barang}', [barangController::class, 'edit']);
Route::get('/barang/{id_barang}', [barangController::class, 'delete']);

//peralatan
Route::get('/form-peralatan', [peralatanController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
