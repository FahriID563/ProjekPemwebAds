<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\CustomerDashboardController;
use App\Http\Controllers\Dashboard\CustomerOrderController;
use App\Http\Controllers\Dashboard\WaiterDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class)->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/admin', AdminDashboardController::class)->name('dashboard.admin');
    });

    Route::middleware('role:pelayan,admin')->group(function () {
        Route::get('/dashboard/waiter', WaiterDashboardController::class)->name('dashboard.waiter');
    });

    Route::middleware('role:customer')->group(function () {
        Route::get('/dashboard/customer', CustomerDashboardController::class)->name('dashboard.customer');
        Route::get('/dashboard/customer/order', CustomerOrderController::class)->name('dashboard.customer.order');
    });
});
