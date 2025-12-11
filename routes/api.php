<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('menu')->name('api.menu.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/available', [MenuController::class, 'available'])->name('available');
    Route::get('/category/{category}', [MenuController::class, 'category'])->name('category');
    Route::post('/', [MenuController::class, 'store'])->name('store');
    Route::put('/{menuItem}', [MenuController::class, 'update'])->name('update');
    Route::patch('/{menuItem}/stock', [MenuController::class, 'updateStock'])->name('update-stock');
    Route::delete('/{menuItem}', [MenuController::class, 'destroy'])->name('destroy');
});

Route::prefix('orders')->name('api.orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/status/{status}', [OrderController::class, 'status'])->name('status');
    Route::get('/user/{user}', [OrderController::class, 'user'])->name('user');
    Route::get('/stats', [OrderController::class, 'stats'])->name('stats');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::put('/{order}/status', [OrderController::class, 'updateStatus'])->name('update-status');
    Route::put('/{order}/payment', [OrderController::class, 'updatePayment'])->name('update-payment');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
});

