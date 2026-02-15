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
use App\Http\Controllers\PengeluaranController;

use App\Http\Controllers\OrderCustomerController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\CustomerProfileController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\GoogleAuthController;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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
Route::get('/customer-login', [AuthCustomerController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer-login', [AuthCustomerController::class, 'login']);
Route::post('/customer/logout', [AuthCustomerController::class, 'logout'])->name('customer.logout');

// Geocode API (perbaikan)
Route::get('/geocode', function (Request $request) {
    $q = $request->query('q');

    if (!$q) {
        return response()->json(['error' => 'Query parameter required'], 400);
    }

    try {
        $response = Http::withHeaders([
            'User-Agent' => 'DLaundry/1.0 (contact@example.com)'
        ])->timeout(10)->get('https://nominatim.openstreetmap.org/search', [
            'format' => 'json',
            'limit' => 5,
            'q' => $q,
            'countrycodes' => 'id', // Filter hanya Indonesia
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to fetch geocode data'], 500);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::middleware(['customer.auth'])->group(function () {
    // Customer Order Routes
    Route::controller(OrderCustomerController::class)->group(function(){
        // Route::get('/customer-orders', 'index')->name('customer.orders');
        Route::post('/customer-orders', 'store')->name('customer.orders.store');
        Route::get('/customer-orders/{id_order}/detail', 'detail')->name('customer.orders.detail');
        
        // Auto login route (TAMBAHKAN INI)
        // Route::post('/customer/auto-login', 'autoLogin')->name('customer.auto.login');

        // Route::get('/customer-dashboard', 'dashboardCustomer');

        // Midtrans Callback
        Route::post('/payment/midtrans/callback', 'handleCallback')->name('payment.callback');

        Route::get('/customer-dashboard', 'dashboardCustomer');
        Route::get('/customer-ordersList', 'orders')->name('customer.orders');
        Route::get('/customer-orders-detail/{id_order}', 'detail');
    });

});

// Customer Order Routes
Route::controller(OrderCustomerController::class)->group(function(){
    Route::get('/customer-orders', 'index')->name('customer.orders');
    Route::post('/customer/auto-login', 'autoLogin')->name('customer.auto.login');
});

Route::controller(TrackingController::class)->group(function(){
    Route::get('/tracking', 'index')->name('tracking.index');
    
    // AJAX endpoint untuk tracking di landing page
    Route::post('/tracking/check', 'check')->name('tracking.check');
    
    // API Routes for real-time status updates
    Route::post('/api/tracking/status', 'checkStatus')->name('api.tracking.status');
    
    // Track dengan QR/Barcode
    Route::post('/tracking/search', 'trackWithCode')->name('tracking.search');
    
    // Alternative route dengan parameter langsung
    Route::get('/track/{kode_order}', function($kode_order) {
        return redirect()->route('tracking.index', ['nota' => $kode_order]);
    })->name('tracking.direct');
});

Route::controller(CustomerProfileController::class)->group(function(){
    Route::get('/customer/profile', 'index')->name('customer.profile');
    Route::post('/customer/profile/update', 'updateProfile')->name('customer.profile.update');
    Route::post('/customer/password/update', 'updatePassword')->name('customer.password.update');
});

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

/////////////////////////////////////////////////////////////////////////////

Route::controller(AuthController::class)->group(function(){
    route::get('/login', 'index')->name('login');
    route::post('/login', 'login')->name('login.post');
    route::get('/customer-login', 'loginCustomer')->name('loginCustomer');
    route::get('/customer-register', 'register');
});

Route::controller(DashboardController::class)->group(function(){
    route::get('/', 'landingPage');
    route::post('/tracking/check', 'checkTracking')->name('tracking.check');
    route::get('/catalog', 'catalog');
    //
    route::get('/customer-orders', 'customerOrders');
});

route::get('/services', function() {
    return view('services');
})->name('services');

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
            // route::get('/exportExcel', 'exportExcel');
            route::post('/exportExcel', 'exportExcel')->name('laporan.exportExcel');
        });

        Route::prefix('pengeluaran')->controller(PengeluaranController::class)->group(function () {
            // MAIN MENU
            route::get('/', 'index')->name('pengeluaran.index');
            // CRUD
            route::get('/create', 'create')->name('pengeluaran.create');
            route::post('/', 'store')->name('pengeluaran.store');
            route::get('/{id}/edit', 'edit')->name('pengeluaran.edit');
            route::put('/{id}', 'update')->name('pengeluaran.update');
            route::delete('/{id}', 'destroy')->name('pengeluaran.destroy');
            // SEARCH (AJAX)
            route::get('/search', 'search')->name('pengeluaran.search');
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

