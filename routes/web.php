<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kendaraanController;
use App\Http\Controllers\peralatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengerjaanController;
use App\Http\Controllers\RegisterController;

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
    return view('login.index');
});

//dashboard
Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('guest');

//Kendaraan
Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::get('/editkendaraan/{id_kendaraan}', [KendaraanController::class, 'edit']);
Route::post('/form-kendaraan-update', [kendaraanController::class, 'update']);
Route::post('/addkendaraan', [KendaraanController::class, 'store']);
Route::get('/kendaraan/{id_kendaraan}', [KendaraanController::class, 'delete']);
Route::get('/movekendaraan/{id_kendaraan}', [KendaraanController::class, 'move']);
Route::post('list-kendaraan-print', [kendaraanController::class, 'print']);
Route::get('list-detail-print/{id}', [kendaraanController::class, 'cetak']);
Route::get('list-kendaraan-search', [kendaraanController::class, 'search']);
Route::get('list-pengerjaan-search', [kendaraanController::class, 'search2']);


//pengerjaan
Route::get('/pengerjaan', [PengerjaanController::class, 'index']);
Route::post('/addpengerjaan', [PengerjaanController::class, 'store']);
Route::get('/editpengerjaan/{id_pengerjaan}', [PengerjaanController::class, 'edit']);
Route::post('/form-pengerjaan-update', [PengerjaanController::class, 'update']);
Route::get('/deletepengerjaan/{id_pengerjaan}', [PengerjaanController::class, 'delete']);
Route::get('/formpengerjaan', [PengerjaanController::class, 'create']);
Route::post('list-pengerjaan-print', [PengerjaanController::class, 'print']);
Route::get('list-pengerjaan-search', [PengerjaanController::class, 'search']);


// Barang
Route::get('/barang', [barangController::class, 'index']);
Route::get('/tblbarang', [barangController::class, 'create']); 
Route::post('/addbarang', [barangController::class, 'store']);
Route::post('/form-barang-update', [barangController::class, 'update']);
Route::get('/editbarang/{id_barang}', [barangController::class, 'edit']); 
Route::get('/deletebarang/{id_barang}', [barangController::class, 'delete']);
Route::post('list-barang-print', [barangController::class, 'print']);
Route::get('list-barang-search', [barangController::class, 'search']);


//peralatan
Route::get('/peralatan', [peralatanController::class, 'index']);
Route::get('/formperalatan', [peralatanController::class, 'create']); 
Route::post('/addperalatan', [peralatanController::class, 'store']);
Route::get('/editperalatan/{id_peralatan}',[peralatanController::class, 'edit']);
Route::post('/form-peralatan-update', [peralatanController::class, 'update']);
Route::get('/deleteperalatan/{id_peralatan}', [peralatanController::class, 'delete']);
Route::post('list-peralatan-print', [peralatanController::class, 'print']);
Route::get('list-peralatan-search', [peralatanController::class, 'search']);


//login
Route::get('/loginform', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-auth', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Register
Route::get('/registerform', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/addregister', [RegisterController::class, 'store']);


