<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectionController;

// header('Access-Control-Allow-Origin: http://localhost:4200');
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
// header('Access-Control-Allow-Credentials: true');

// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     header('HTTP/1.1 200 OK');
//     exit();
// }

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/direcciones', [DirectionController::class, 'index']);
    Route::post('/direcciones', [DirectionController::class, 'store']);
    Route::get('/direcciones/{id}', [DirectionController::class, 'show']);
    Route::put('/direcciones/{id}', [DirectionController::class, 'update']);
    Route::delete('/direcciones/{id}', [DirectionController::class, 'destroy']);
});
