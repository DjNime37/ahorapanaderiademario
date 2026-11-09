<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/productos', [ProductoApiController::class, 'index'])->middleware('throttle:60,1');
Route::get('/productos/{id}', [ProductoApiController::class, 'show'])->middleware('throttle:60,1');
