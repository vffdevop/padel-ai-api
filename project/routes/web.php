<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/health', function () {
    return '{"status" : "ok"}';
});

Route::get('/health2', function () {
    return response()->json([
            'status' => 'ok'
        ], Response::HTTP_OK);
});