<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::apiResource('tasks', TaskController::class);

Route::get('/health', function () {
    return '{"status" : "ok"}';
});
