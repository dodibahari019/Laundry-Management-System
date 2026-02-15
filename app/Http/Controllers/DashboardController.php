<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Layanan;
use App\Models\Orders;
use App\Models\Pelanggan;
use App\Models\Users;
use App\Models\Pembayaran;
use App\Models\OrderStatusLog;
use App\Models\OrderItems;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user_login = Session::get('id_user');
        $username_login = Session::get('username');
        $role_login = Session::get('role');
        $nama_login = Session::get('nama');
        return view('dashboard.main', compact('id_user_login', 'username_login', 'role_login', 'nama_login'));
    }

    public function getData()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $last7Days = Carbon::today()->subDays(6);

        // Total Order
        $totalOrderToday = Orders::whereDate('tanggal_masuk', $today)->count();
        $totalOrderYesterday = Orders::whereDate('tanggal_masuk', $yesterday)->count();

        // Order dalam proses
        $totalOrderProcess = Orders::whereIn('status_order', ['diproses', 'dicuci', 'disetrika'])
            ->whereDate('tanggal_masuk', $today)
            ->count();
        
        $prosesCount = Orders::where('status_order', 'diproses')
            ->whereDate('tanggal_masuk', $today)
            ->count();
        
        $cuciCount = Orders::where('status_order', 'dicuci')
            ->whereDate('tanggal_masuk', $today)
            ->count();
        
        $setrikaCount = Orders::where('status_order', 'disetrika')
            ->whereDate('tanggal_masuk', $today)
            ->count();

        // Order selesai
        $totalOrderDone = Orders::whereDate('tanggal_selesai', $today)
            ->whereIn('status_order', ['ready', 'diambil'])
            ->count();
        
        $takenCount = Orders::where('status_order', 'diambil')
            ->whereDate('tanggal_selesai', $today)
            ->count();

        // Revenue
        $totalRevenueToday = Orders::whereDate('tanggal_masuk', $today)->sum('total');
        $revenueYesterday = Orders::whereDate('tanggal_masuk', $yesterday)->sum('total');
        $targetRevenue = 4000000;

        // Status counts
        $statusWaiting = Orders::where('status_order', 'menunggu')->count();
        $statusProcess = Orders::where('status_order', 'diproses')->count();
        $statusWashing = Orders::where('status_order', 'dicuci')->count();
        $statusIroning = Orders::where('status_order', 'disetrika')->count();
        $statusReady = Orders::where('status_order', 'ready')->count();
        $statusDiambil = Orders::where('status_order', 'diambil')->count();

        // Chart data - Order 7 hari
        $orderChartData = [];
        $orderChartLabels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $orderChartLabels[] = $date->locale('id')->isoFormat('ddd');
            $orderChartData[] = Orders::whereDate('tanggal_masuk', $date)->count();
        }

        // Chart data - Revenue 7 hari
        $revenueChartData = [];
        $revenueChartLabels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $revenueChartLabels[] = $date->locale('id')->isoFormat('ddd');
            $revenue = Orders::whereDate('tanggal_masuk', $date)->sum('total');
            $revenueChartData[] = round($revenue / 1000);
        }

        // Status chart data
        $statusChartData = [
            $statusWaiting,
            $statusProcess,
            $statusWashing,
            $statusIroning,
            $statusReady,
            $statusDiambil
        ];

        // Service distribution - PERBAIKAN: menggunakan tb_order_items
        $serviceDistribution = OrderItems::join('tb_layanan', 'tb_order_items.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select('tb_layanan.nama_layanan', DB::raw('SUM(tb_order_items.qty) as total'))
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviceChartLabels = $serviceDistribution->pluck('nama_layanan')->toArray();
        $serviceChartData = $serviceDistribution->pluck('total')->toArray();

        // Queue orders - PERBAIKAN: eager load orderItems dengan layanan
        $queueOrders = Orders::with(['pelanggan', 'orderItems.layanan'])
            ->whereIn('status_order', ['menunggu', 'diproses', 'dicuci', 'disetrika', 'ready'])
            ->orderByRaw("FIELD(status_order, 'menunggu', 'diproses', 'dicuci', 'disetrika', 'ready')")
            ->orderBy('tanggal_masuk', 'asc')
            ->take(5)
            ->get();

        // Recent orders - PERBAIKAN: eager load orderItems dengan layanan
        $recentOrders = Orders::with(['pelanggan', 'orderItems.layanan'])
            ->orderBy('tanggal_masuk', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'totalOrderToday' => $totalOrderToday,
            'totalOrderYesterday' => $totalOrderYesterday,
            'totalOrderProcess' => $totalOrderProcess,
            'prosesCount' => $prosesCount,
            'cuciCount' => $cuciCount,
            'setrikaCount' => $setrikaCount,
            'totalOrderDone' => $totalOrderDone,
            'takenCount' => $takenCount,
            'totalRevenueToday' => $totalRevenueToday,
            'revenueYesterday' => $revenueYesterday,
            'targetRevenue' => $targetRevenue,

            'statusWaiting' => $statusWaiting,
            'statusProcess' => $statusProcess,
            'statusWashing' => $statusWashing,
            'statusIroning' => $statusIroning,
            'statusReady' => $statusReady,
            'statusDiambil' => $statusDiambil,

            'orderChartLabels' => $orderChartLabels,
            'orderChartData' => $orderChartData,
            'revenueChartLabels' => $revenueChartLabels,
            'revenueChartData' => $revenueChartData,
            'statusChartData' => $statusChartData,
            'serviceChartLabels' => $serviceChartLabels,
            'serviceChartData' => $serviceChartData,

            'queueOrders' => $queueOrders,
            'recentOrders' => $recentOrders,
        ]);
    }

    public function aboutUs(){
        $id_user_login = Session::get('id_user');
        $username_login = Session::get('username');
        $role_login = Session::get('role');
        $nama_login = Session::get('nama');
        return view('aboutUs.about', compact('id_user_login', 'username_login', 'role_login', 'nama_login'));
    }

    public function landingPage(){
        if (auth()->check()) {
            $role = auth()->user()->role;

            return match ($role) {
                'admin'   => redirect('/dashboard'),
                'kasir'   => redirect('/orders'),
                'petugas' => redirect('/orders'),
                default   => redirect('/login'),
            };
        }

        // Get top 6 layanan (mixed kiloan & satuan)
        $top6Layanan = Layanan::leftJoin('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->leftJoin('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(6)
            ->get();

        $dataLayanan = Layanan::where('status', 'Aktif')->orderBy('nama_layanan')->get();
        $top4Layanan = Layanan::leftJoin('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->leftJoin('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->leftJoin('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

        return view('landingPage', compact('top6Layanan', 'dataLayanan', 'top4Layanan'));
    }

    /**
     * Katalog Page - Show all services with filters
     */
    public function catalog()
    {
         // Get all active services dengan join untuk mendapatkan jumlah transaksi
        $allLayanan = Layanan::leftJoin('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->leftJoin('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('tb_layanan.nama_layanan', 'ASC')
            ->get();

        $top4Layanan = Layanan::leftJoin('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->leftJoin('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->leftJoin('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

        return view('services', compact('allLayanan', 'top4Layanan'));
    }

    public function checkTracking(Request $request)
    {
        $request->validate([
            'nota' => 'required|string'
        ]);

        $kodeOrder = strtoupper(trim($request->nota));

        // Cari order berdasarkan kode
        $order = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_orders.catatan',
            'tb_pelanggan.nama',
            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
        ])
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->join('tb_order_items', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
        ->where('tb_orders.kode_order', $kodeOrder)
        ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Kode order tidak ditemukan. Pastikan Anda memasukkan kode dengan benar.'
            ]);
        }

        // Ambil riwayat status
        $statusLogs = OrderStatusLog::select([
            'tb_order_status_logs.status',
            'tb_order_status_logs.tanggal_ubah',
            'tb_users.nama'
        ])
        ->join('tb_users', 'tb_order_status_logs.id_user', '=', 'tb_users.id_user')
        ->where('tb_order_status_logs.id_order', $order->id_order)
        ->orderBy('tb_order_status_logs.tanggal_ubah', 'DESC')
        ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'order' => $order,
                'statusLogs' => $statusLogs
            ]
        ]);
    }

    public function customerOrders(){
        $user = Auth::guard('pelanggan')->user();
        /* =========================
        DEFAULT VALUE (belum login)
        ========================= */
        $firstName = '';
        $lastName  = '';
        $noHp      = '';
        $gender    = '';
        $email     = '';

        /* =========================
        JIKA SUDAH LOGIN
        ========================= */
        if ($user) {

            // 1. Split nama
            $nama = trim($user->nama ?? '');
            $namaParts = explode(' ', $nama, 2);

            $firstName = $namaParts[0] ?? '';
            $lastName  = $namaParts[1] ?? '';

            // 2. Nomor HP (buang 0 depan)
            $noHp = $user->no_hp ?? '';
            if ($noHp && str_starts_with($noHp, '0')) {
                $noHp = substr($noHp, 1);
            }

            // 3. Gender
            $gender = $user->gender ?? '';
            $email = $user->email ?? '';
        }

        $currentlyDate = Carbon::now()->format('Y-m-d');

        $top4Layanan = Layanan::leftJoin('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->leftJoin('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->leftJoin('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

        $dataLayanan = Layanan::where('status', 'Aktif')->orderBy('nama_layanan')->get();

        return view('pemesananPage', compact('top4Layanan', 'currentlyDate', 'dataLayanan', 'firstName',
            'lastName',
            'noHp',
            'gender',
            'email'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}