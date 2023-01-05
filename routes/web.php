<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'create'])->name('home');
Route::post('/orders', [OrderController::class, 'store']);

Route::get('/all-products', [ProductController::class, 'all']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'index']);
    Route::post('/login', [UserController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/all-orders', [OrderController::class, 'all']);
    Route::put('/orders/{order}', [OrderController::class, 'update']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}', [ProductController::class, 'edit']);
    Route::post('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});
