<?php

use App\Http\Controllers\API\AuthControllerphp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TpsController;


Route::post('/login', [AuthControllerphp::class, 'login']);

// Protected routes (akses pakai token)
Route::middleware(['auth:api'])->group(function () {
    Route::get('/tps', [TpsController::class, 'index']);     
    Route::get('/tps/{id}', [TpsController::class, 'show']);  
});
