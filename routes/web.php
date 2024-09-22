<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;


Route::get('/', [ProductController::class, 'index']) ->name('home');
Route::resource('products', ProductController::class);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);