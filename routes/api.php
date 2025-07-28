<?php

use App\Http\Controllers\API\AuthControllerphp;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\UPTDController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TpsController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LaporanPembersihanController;
use App\Http\Controllers\API\BuktiTransaksiController;
use App\Http\Controllers\API\RitasiController;
use App\Http\Controllers\API\RitasiKertawinangunController;
use App\Http\Controllers\API\UserUptdController;
use App\Http\Controllers\API\VehicleesController;

Route::post('/login', [AuthControllerphp::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::get('/users/{id}', [UserController::class, 'getUserById']);

    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);

});

// Protected routes (akses pakai token)
Route::middleware(['auth:api'])->group(function () {
    Route::get('/tps', [TpsController::class, 'index']); 
    // Route::get('/tps/{id}', [TpsController::class, 'show']);
    Route::get('/tps/{id_uptd}', [TpsController::class, 'getByUptd']);
  

    Route::post('/update-avatar/{id}', [UserController::class, 'updateAvatar']);

    Route::post('/tps-store', [TpsController::class, 'store']);
    Route::put('/tps/{id}', [TpsController::class, 'update']);
    Route::put('/tps/{id}', [TpsController::class, 'delete']);

    Route::get('/laporan', [LaporanPembersihanController::class, 'index']);
    Route::get('/laporanSupir', [LaporanPembersihanController::class, 'indexBySupir']);

    Route::post('/bukti-transaksi-store', [BuktiTransaksiController::class, 'store']);
    Route::get('/bukti-transaksi', [BuktiTransaksiController::class, 'index']);
});

Route::middleware(['auth:api'])->group(function () {
   
    Route::get('/roles', [RolesController::class, 'getAllRole']);

    Route::post('/roles', [RolesController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/uptd', [UPTDController::class, 'getAllUptd']);
    Route::post('/uptd', [UPTDController::class, 'store']);

});

Route::middleware('auth:api')->group(function () {
    Route::get('/users_uptd/{id}', [UserUptdController::class, 'show']);
    Route::get('/driver/{id}', [UserUptdController::class, 'driversByUptd']);
    
    Route::post('/users_uptd', [UserUptdController::class, 'store']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/vehicle/{id_uptd}', [VehicleesController::class, 'vehicleByUptd']);
    Route::post('/vehicle', [VehicleesController::class, 'store']);

});

Route::middleware('auth:api')->group(function () {
    Route::get('/ritasi_tpa_pecuk', [RitasiController::class, 'index']);
    Route::get('/ritasi_tpa_kertawinangun', [RitasiKertawinangunController::class, 'kertawinangun']);

});

