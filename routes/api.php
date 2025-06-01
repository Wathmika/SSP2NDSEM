<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductApiController::class, 'index']);

Route::get('products/{id}', [ProductApiController::class, 'show']);
Route::post('products', [ProductApiController::class, 'store']);
Route::put('products/{id}', [ProductApiController::class, 'update']);
Route::delete('products/{id}', [ProductApiController::class, 'destroy']);


