<?php

use App\Http\Controllers\API\AuthControllerphp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TpsController;
use App\Http\Controllers\API\UserController;

Route::post('/login', [AuthControllerphp::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::get('/users/{id}', [UserController::class, 'getUserById']);

    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
});

// Protected routes (akses pakai token)
Route::middleware(['auth:api'])->group(function () {
    Route::get('/tps', [TpsController::class, 'index']);     
    Route::get('/tps/{id}', [TpsController::class, 'show']);  
});
