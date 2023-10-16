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
Route::get('/editkendaraan/{id_kendaraan}', [KendaraanController::class, 'edit']);
Route::post('/form-kendaraan-update', [kendaraanController::class, 'update']);
Route::post('/addkendaraan', [KendaraanController::class, 'store']);
Route::get('/kendaraan/{id_kendaraan}', [KendaraanController::class, 'delete']);
Route::get('/movekendaraan/{id_kendaraan}', [KendaraanController::class, 'move']);


//pengerjaan
Route::get('/pengerjaan', [PengerjaanController::class, 'index']);
Route::post('/addpengerjaan', [PengerjaanController::class, 'store']);
Route::get('/editpengerjaan/{id_pengerjaan}', [PengerjaanController::class, 'edit']);
Route::post('/form-pengerjaan-update', [PengerjaanController::class, 'update']);
Route::get('/deletepengerjaan/{id_pengerjaan}', [PengerjaanController::class, 'delete']);
Route::get('/formpengerjaan', [PengerjaanController::class, 'create']); 

// Barang
Route::get('/barang', [barangController::class, 'index']);
Route::get('/tblbarang', [barangController::class, 'create']); 
Route::post('/addbarang', [barangController::class, 'store']);
Route::post('/form-barang-update', [barangController::class, 'update']);
Route::get('/editbarang/{id_barang}', [barangController::class, 'edit']); 
Route::get('/deletebarang/{id_barang}', [barangController::class, 'delete']);


//peralatan
Route::get('/peralatan', [peralatanController::class, 'index']);
Route::post('/addperalatan', [peralatanController::class, 'store']);
Route::get('/editperalatan/{id_peralatan}',[peralatanController::class, 'edit']);
Route::get('/deleteperalatan/{id_peralatan}', [peralatanController::class, 'delete']);

Route::get('/login', [LoginController::class, 'index']);
