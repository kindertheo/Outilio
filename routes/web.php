<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Mail\Order as MailOrder;
use Illuminate\Support\Facades\Mail;
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

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');;
    Route::get('/all-orders', [OrderController::class, 'all']);
    Route::put('/orders/{order}', [OrderController::class, 'update']);

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}', [ProductController::class, 'edit'])->name('products.edit');;
    Route::post('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});

Route::get('/test-email', function () {
    Mail::to('jhon.doe.mns@gmail.com')
        ->send(new MailOrder([
            'nom' => 'Durand',
            'email' => 'jhon.doe.mns@gmail.com',
            'message' => 'Je voulais vous dire que votre site est magnifique !'
        ]));
});
