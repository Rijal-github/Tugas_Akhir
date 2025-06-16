<?php

use App\Http\Controllers\API\AuthControllerphp;
use App\Http\Controllers\API\RolesController;
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
    Route::put('/users/{id}', [UserController::class, 'delete']);

});

// Protected routes (akses pakai token)
Route::middleware(['auth:api'])->group(function () {
    Route::get('/tps', [TpsController::class, 'index']);     
    Route::get('/tps/{id}', [TpsController::class, 'show']);  

    Route::post('/tps', [TpsController::class, 'store']);
    Route::put('/tps/{id}', [TpsController::class, 'update']);
    Route::put('/tps/{id}', [TpsController::class, 'delete']);
});

Route::middleware(['auth:api'])->group(function () {
   
    Route::get('/roles', [RolesController::class, 'getAllRole']);

    Route::post('/roles', [RolesController::class, 'store']);
});

