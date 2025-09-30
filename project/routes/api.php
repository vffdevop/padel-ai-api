<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;
use Symfony\Component\HttpFoundation\Response;

Route::apiResource('tasks', TaskController::class);

Route::get('/health', function () {
            return response()->json([
            'success' => true,
            'message' => 'Health OK'
        ],Response::HTTP_OK);
});

Route::put('/test', function() {
    return response()->json(['ok' => true]);
});

// Rutas públicas (sin autenticación)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    
    Route::apiResource('tasks', TaskController::class);
});