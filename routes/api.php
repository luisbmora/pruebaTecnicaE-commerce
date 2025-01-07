<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DireccionController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/direcciones', [DireccionController::class, 'index']);
    Route::post('/direcciones', [DireccionController::class, 'store']);
    Route::get('/direcciones/{id}', [DireccionController::class, 'show']);
    Route::put('/direcciones/{id}', [DireccionController::class, 'update']);
    Route::delete('/direcciones/{id}', [DireccionController::class, 'destroy']);
});
