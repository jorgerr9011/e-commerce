<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\productController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Product Endpoints

Route::get('/products', [productController::class, 'find']);

Route::post('/products', [productController::class, 'save']);

Route::get('/products/{id}', [productController::class, 'findById']);

Route::delete('/products/{id}', [productController::class, 'deleteById']);

Route::delete('/products/{id}', [productController::class, 'updateById']);