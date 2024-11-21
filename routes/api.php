<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\productController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Product Endpoints

/*
    Es una buena práctica darle nombres a las rutas, para 
    poder utilizarlas más facilmente y sin fallos en el 
    futuro.
*/

Route::get('/products', [productController::class, 'find'])->name('product.find');

Route::post('/products', [productController::class, 'save'])->name('product.save');

Route::get('/products/{id}', [productController::class, 'findById'])->name('product.findById');

Route::delete('/products/{id}', [productController::class, 'deleteById'])->name('product.deleteById');

Route::put('/products/{id}', [productController::class, 'updateById'])->name('product.updateById');
