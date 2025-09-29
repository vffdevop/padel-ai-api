<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use Symfony\Component\HttpFoundation\Response;

Route::apiResource('tasks', TaskController::class);

Route::get('/health', function () {
    return '{"status" : "ok"}';
});
