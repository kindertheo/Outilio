<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'create']);
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders', [OrderController::class, 'update']);

Route::get('/products', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/all-products', [ProductController::class, 'all']);
