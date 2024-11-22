<?php

use App\Http\Controllers\Api\productController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::view('/', 'index')->name('index');

Route::view('/about', 'about')->name('about');

Route::view('/contact', 'contact')->name('contact');

Route::view('/services', 'services')->name('services');

Route::get('/products', [productController::class, 'productIndex']);