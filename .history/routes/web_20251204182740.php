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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    route::get('/login', 'index')->name('login');
    route::post('/login', 'login');
});

Route::prefix('dashboard')->controller(DashboardController::class)->group(function(){
    // MAIN
    route::get('/', 'index');
    route::get('/getData', 'getData');
});

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

Route::prefix('orders')->controller(OrderController::class)->group(function(){
    // MAIN
    route::get('/', 'index');
    // CRUD
    route::get('/create', 'create');
    route::post('/', 'store');
    route::get('/{id_order}/edit', 'edit');
    route::put('/{id_order}/{id_pembayaran}', 'update');
    route::delete('/{id_order}', 'destroy');
    // DATA TABLE
    route::get('/search', 'search');
    // OTHER
    route::get('/create-pelanggan', 'createPelanggan');
    route::post('/pelanggan', 'storePelanggan');
    route::get('/{id_order}/detail', 'detail');
    route::post('/{id_order}/cancel', 'cancel');
    route::post('/{id_order}/change', 'change');
    Route::get('/print-struk/{id_order}', 'printStruk');
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
