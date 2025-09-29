<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
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