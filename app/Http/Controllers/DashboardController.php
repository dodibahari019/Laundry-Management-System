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

        $totalOrderToday = Orders::whereDate('tanggal_masuk', $today)->count();
        $totalOrderYesterday = Orders::whereDate('tanggal_masuk', $yesterday)->count();

        $totalOrderProcess = Orders::whereIn('status_order', ['diproses', 'dicuci', 'disetrika'])->whereDate('tanggal_masuk', $today)->count();
        $prosesCount = Orders::where('status_order', 'diproses')->whereDate('tanggal_masuk', $today)->count();
        $cuciCount = Orders::where('status_order', 'dicuci')->whereDate('tanggal_masuk', $today)->count();
        $setrikaCount = Orders::where('status_order', 'disetrika')->whereDate('tanggal_masuk', $today)->count();

        $totalOrderDone = Orders::whereDate('tanggal_selesai', $today)
            ->whereIn('status_order', ['ready', 'diambil'])
            ->count();
        $takenCount = Orders::where('status_order', 'diambil')
            ->whereDate('tanggal_selesai', $today)
            ->count();

        $totalRevenueToday = Orders::whereDate('tanggal_masuk', $today)->sum('total');
        $revenueYesterday = Orders::whereDate('tanggal_masuk', $yesterday)->sum('total');
        $targetRevenue = 4000000;

        $statusWaiting = Orders::where('status_order', 'menunggu')->count();
        $statusProcess = Orders::where('status_order', 'diproses')->count();
        $statusWashing = Orders::where('status_order', 'dicuci')->count();
        $statusIroning = Orders::where('status_order', 'disetrika')->count();
        $statusReady = Orders::where('status_order', 'ready')->count();
        $statusDiambil = Orders::where('status_order', 'diambil')->count();

        $orderChartData = [];
        $orderChartLabels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $orderChartLabels[] = $date->locale('id')->isoFormat('ddd');
            $orderChartData[] = Orders::whereDate('tanggal_masuk', $date)->count();
        }

        $revenueChartData = [];
        $revenueChartLabels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $revenueChartLabels[] = $date->locale('id')->isoFormat('ddd');
            $revenue = Orders::whereDate('tanggal_masuk', $date)->sum('total');
            $revenueChartData[] = round($revenue / 1000);
        }

        $statusChartData = [
            $statusWaiting,
            $statusProcess,
            $statusWashing,
            $statusIroning,
            $statusReady,
            $statusDiambil
        ];

        $serviceDistribution = Orders::join('tb_layanan', 'tb_orders.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select('tb_layanan.nama_layanan', DB::raw('count(*) as total'))
            ->groupBy('tb_layanan.nama_layanan')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $serviceChartLabels = $serviceDistribution->pluck('nama_layanan')->toArray();
        $serviceChartData = $serviceDistribution->pluck('total')->toArray();

        $queueOrders = Orders::with(['pelanggan', 'layanan'])
            ->whereIn('status_order', ['menunggu', 'diproses', 'dicuci', 'disetrika', 'ready'])
            ->orderByRaw("FIELD(status_order, 'menunggu', 'diproses', 'dicuci', 'disetrika', 'ready')")
            ->orderBy('tanggal_masuk', 'asc')
            ->take(5)
            ->get();

        $recentOrders = Orders::with(['pelanggan', 'layanan'])
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

        $dataLayananKiloan = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
            ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
            )
            ->where('tb_layanan.jenis', 'kiloan')
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

        $dataLayananSatuan = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
            ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
            )
            ->where('tb_layanan.jenis', 'satuan')
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

         $top4Layanan = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
            ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
            )
            ->where('tb_layanan.status', 'Aktif')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

        return view('landingPage', compact('dataLayananKiloan', 'dataLayananSatuan', 'top4Layanan'));
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
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
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
