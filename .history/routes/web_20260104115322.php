<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusLogController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Email Verification Routes
Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verify.email');
Route::post('/resend-verification', [RegisterController::class, 'resendVerification'])->name('resend.verification');

// Customer Login Routes
Route::get('/customer-login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerLoginController::class, 'login']);
Route::post('/customer/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Protected Customer Routes
Route::middleware(['auth:pelanggan', 'verified.customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    // ... tambahkan route customer lainnya
});

Route::controller(AuthController::class)->group(function(){
    route::get('/login', 'index')->name('login');
    route::post('/login', 'login')->name('login.post');
    route::get('/customer-login', 'loginCustomer')->name('loginCustomer');
    route::get('/customer-register', 'register');
});

Route::controller(DashboardController::class)->group(function(){
    route::get('/', 'landingPage');
    route::post('/tracking/check', 'checkTracking')->name('tracking.check');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AuthController::class)->group(function(){
        route::post('/logout', 'logout');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard', 'index')->middleware('role:admin');
        Route::get('/dashboard/getData', 'getData')->middleware('role:admin');
        Route::get('/about-us', 'aboutUs');
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::prefix('users')->controller(UserController::class)->group(function(){
            // MAIN MENU
            route::get('/', 'index');
            // CRUD
            route::get('/create', 'create');
            route::post('/', 'store');
            route::get('/{id_user}/edit', 'edit');
            route::put('/{id_user}', 'update');
            route::delete('/{id_user}', 'destroy');
            // OTHER
            route::get('/search', 'search');
        });

        Route::prefix('pelanggan')->controller(PelangganController::class)->group(function(){
            // MAIN MENU
            route::get('/', 'index');
            // CRUD
            route::get('/create', 'create');
            route::post('/','store');
            route::get('/{id_pelanggan}/edit', 'edit');
            route::put('/{id_pelanggan}', 'update');
            route::delete('/{id_pelanggan}', 'destroy');
            // DATA TABLE
            route::get('/search', 'search');
        });

        Route::prefix('layanan')->controller(LayananController::class)->group(function(){
            // MAIN MENU
            route::get('/', 'index');
            // CRUD
            route::get('/create', 'create');
            route::post('/', 'store');
            route::get('/{id_layanan}/edit', 'edit');
            route::put('/{id_layanan}', 'update');
            route::delete('/{id_layanan}', 'destroy');
            // DATA TABLE
            route::get('/search', 'search');
        });

        Route::prefix('laporan')->controller(ReportController::class)->group(function(){
            // MAIN
            route::get('/', 'index');
            // DATA TABLE
            route::get('/generateReport', 'generateReport');
            // PDF
            route::get('/exportPDF', 'exportPdf');
            // EXCEL
            route::get('/exportExcel', 'exportExcel');
        });
    });

    Route::prefix('orders')->controller(OrderController::class)->group(function(){
        // MAIN
        route::get('/', 'index');
        // CRUD
        route::get('/create', 'create')->middleware('role:admin,kasir');
        route::post('/', 'store')->middleware('role:admin,kasir');
        route::get('/{id_order}/edit', 'edit')->middleware('role:admin,kasir');
        route::put('/{id_order}/{id_pembayaran}', 'update')->middleware('role:admin,kasir');
        route::delete('/{id_order}', 'destroy')->middleware('role:admin,kasir');
        // DATA TABLE
        route::get('/search', 'search');
        // OTHER
        route::get('/create-pelanggan', 'createPelanggan')->middleware('role:admin,kasir');
        route::post('/pelanggan', 'storePelanggan')->middleware('role:admin,kasir');
        route::get('/{id_order}/detail', 'detail');
        route::post('/{id_order}/cancel', 'cancel')->middleware('role:admin,kasir');
        route::post('/{id_order}/change', 'change')->middleware('role:admin,petugas');
        Route::get('/print-struk/{id_order}', 'printStruk')->middleware('role:admin,kasir');
    });

});

