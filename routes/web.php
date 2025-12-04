<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusLogController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('login');
});

Route::prefix('dashboard')->controller(DashboardController::class)->group(function(){
    // MAIN
    route::get('/', 'index');
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
    route::get('/getViewLayanan', 'getViewLayanan');
});

Route::prefix('orders')->controller(OrderController::class)->group(function(){
    // MAIN
    route::get('/', 'index');
    // CRUD
    route::get('/create', 'create');
    route::post('/', 'store');
    route::get('/{id_order}/edit', 'edit');
    route::put('/{id_order}', 'update');
    route::delete('/{id_order}', 'destroy');
});

Route::prefix('laporan')->controller(ReportController::class)->group(function(){
    route::get('/', 'index');
});

Route::get('/about-us', function () {
    return view('about');
});