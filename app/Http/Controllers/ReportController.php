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
use Barryvdh\DomPDF\Facade\Pdf;
// use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
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
        $totalTransaksi = Orders::whereDate('tanggal_masuk', today())->count() ?? 0;
        $totalPendapatan = Orders::whereDate('tanggal_masuk', today())->sum('total') ?? 0;
        $totalPelanggan = Orders::whereDate('tanggal_masuk', today())->distinct('id_pelanggan')->count('id_pelanggan') ?? 0;
        $rataRata = Orders::whereDate('tanggal_masuk', today())->avg('total') ?? 0;

        $currentlyDate = Carbon::now()->format('Y-m-d');
        $dataOrder = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',

            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',

            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',

            'tb_orders.berat',
            'tb_orders.jumlah',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.catatan',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',

            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah as jumlahBayar',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
            ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
            ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
            ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
            ->whereDate('tb_orders.tanggal_masuk', $currentlyDate)
            ->orderBy('tb_orders.kode_order', 'DESC')
            ->get();
        return view('reports.main', compact('dataOrder', 'currentlyDate', 'totalTransaksi', 'totalPendapatan', 'totalPelanggan', 'rataRata', 'id_user_login', 'username_login', 'role_login', 'nama_login'));
    }

    public function search(Request $request)
    {
        $jenisLaporan = $request->get('jenisLaporan', '');
        $periodType = $request->get('periodType', '');
        $startDate = $request->get('startDate', '');
        $endDate = $request->get('endDate', '');
        $orders = $request->get('orders', '');
        $status = $request->get('status', '');
        $tanggal = $request->get('tanggal', '');



        $dataOrders = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',

            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',

            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',

            'tb_orders.berat',
            'tb_orders.jumlah',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.catatan',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',

            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah as jumlahBayar',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
            ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
            ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
            ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
            ->orderBy('tb_orders.kode_order', 'DESC');

        if ($jenisLaporan == 'transaksi') {
            $dataOrders->whereBetween('tb_orders.tanggal_masuk', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        if ($orders) {
            $dataOrders->where(function ($q) use ($orders) {
                $q->where('tb_orders.kode_order', 'LIKE', "%{$orders}%")
                    ->orWhere('tb_pelanggan.nama', 'LIKE', "%{$orders}%")
                    // ->orWhere('tb_pelanggan.no_hp', 'LIKE', "%{$order}%")
                    // ->orWhere('tb_layanan.nama_layanan', 'LIKE', "%{$order}%")
                    // ->orWhere('tb_layanan.jenis', 'LIKE', "%{$order}%")
                ;
            });
        }

        if ($status) {
            if ($status == 'menunggu') {
                $dataOrders->where('tb_orders.status_order', 'menunggu');
            } elseif ($status == 'diproses') {
                $dataOrders->where('tb_orders.status_order', 'diproses');
            } elseif ($status == 'dicuci') {
                $dataOrders->where('tb_orders.status_order', 'dicuci');
            } elseif ($status == 'disetrika') {
                $dataOrders->where('tb_orders.status_order', 'disetrika');
            } elseif ($status == 'ready') {
                $dataOrders->where('tb_orders.status_order', 'ready');
            } elseif ($status == 'diambil') {
                $dataOrders->where('tb_orders.status_order', 'diambil');
            } elseif ($status == 'dibatalkan') {
                $dataOrders->where('tb_orders.status_order', 'dibatalkan');
            }
        }

        if ($tanggal) {
            $dataOrders->whereDate('tb_orders.tanggal_masuk', $tanggal);
        }


        $dataOrders = $dataOrders->orderBy('tb_orders.kode_order', 'DESC')->paginate(10);
        // Hitung jumlah aktif/nonaktif
        // $jumlahSemua = $dataOrders->count();
        // $jumlahAktif = $dataOrders->where('tb_orders.status_order', 'Aktif')->count();
        // $jumlahNonAktif = $dataOrders->where('tb_orders.status_order', '!=', 'Aktif')->count();


        return response()->json([
            'data' => $dataOrders->items(),
            'current_page' => $dataOrders->currentPage(),
            'last_page' => $dataOrders->lastPage(),
            'per_page' => $dataOrders->perPage(),
            'total' => $dataOrders->total(),
            // 'jumlahSemua' => $jumlahSemua,
            // 'jumlahAktif' => $jumlahAktif,
            // 'jumlahNonAktif' => $jumlahNonAktif,
        ]);
    }

    public function generateReport(Request $request)
    {
        $jenisLaporan = $request->jenisLaporan;
        $periodType = $request->periodType;
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        if ($periodType !== 'custom') {
            switch ($periodType) {
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;

                case 'week':
                    $startDate = now()->startOfWeek();
                    $endDate = now()->endOfWeek();
                    break;

                case 'month':
                    $startDate = now()->startOfMonth();
                    $endDate = now()->endOfMonth();
                    break;

                case 'year':
                    $startDate = now()->startOfYear();
                    $endDate = now()->endOfYear();
                    break;
            }
        }

        // Format jika custom (string → Carbon)
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        if ($jenisLaporan == 'transaksi') {
            $dataOrders = Orders::select([
                'tb_orders.id_order',
                'tb_orders.kode_order',

                'tb_pelanggan.nama',
                'tb_pelanggan.no_hp',

                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',

                'tb_orders.berat',
                'tb_orders.jumlah',
                'tb_orders.total',
                'tb_orders.status_order',
                'tb_orders.catatan',
                'tb_orders.tanggal_masuk',
                'tb_orders.tanggal_selesai',

                'tb_pembayaran.metode',
                'tb_pembayaran.jumlah as jumlahBayar',
                'tb_pembayaran.kembalian',
                'tb_pembayaran.bukti_transfer',
            ])
                ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->orderBy('tb_orders.kode_order', 'DESC')
                ->get();

            $allTransaksi = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->count('tb_orders.id_order');

            $allPendapatan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->sum('tb_orders.total');

            $allRataRata = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->avg('tb_orders.total');

            $allPelanggan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->distinct('tb_orders.id_pelanggan')
                ->count('tb_orders.id_pelanggan');

            return response()->json([
                "data" => $dataOrders,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allPelanggan" => $allPelanggan,
                "allRataRata" => $allRataRata,
            ]);
        } else if ($jenisLaporan == 'pendapatan') {
            $dataPendapatan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    Orders::raw('DATE(tb_orders.tanggal_masuk) as tanggal_transaksi'),
                    Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    Orders::raw('SUM(tb_orders.total) as total_pendapatan'),
                    Orders::raw('AVG(tb_orders.total) as rata_rata_per_transaksi')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tanggal_transaksi')
                ->orderBy('tb_orders.tanggal_masuk', 'ASC')
                ->get();

            $allTransaksi = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->count('tb_orders.id_order');

            $allPendapatan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->sum('tb_orders.total');

            $allRataRata = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->avg('tb_orders.total');

            $allPelanggan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->distinct('tb_orders.id_pelanggan')
                ->count('tb_orders.id_pelanggan');

            return response()->json([
                "data" => $dataPendapatan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allPelanggan" => $allPelanggan,
                "allRataRata" => $allRataRata,
            ]);
        } else if ($jenisLaporan == 'pelanggan') {
            $dataPelanggan = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    'tb_pelanggan.id_pelanggan',
                    'tb_pelanggan.nama as nama_pelanggan',
                    'tb_pelanggan.no_hp',
                    Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    Orders::raw('SUM(tb_orders.total) as total_belanja'),
                    Orders::raw('AVG(tb_orders.total) as rata_rata_belanja'),
                    Orders::raw('MAX(tb_orders.tanggal_masuk) as tanggal_transaksi_terakhir')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tb_pelanggan.id_pelanggan', 'tb_pelanggan.nama', 'tb_pelanggan.no_hp')
                ->orderBy('tb_pelanggan.nama', 'ASC')
                ->get();

            $allTransaksi = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->count('tb_orders.id_order');

            $allPendapatan = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->sum('tb_orders.total');

            $allRataRata = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->avg('tb_orders.total');

            $allPelanggan = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->distinct('tb_orders.id_pelanggan')
                ->count('tb_orders.id_pelanggan');

            return response()->json([
                "data" => $dataPelanggan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allPelanggan" => $allPelanggan,
                "allRataRata" => $allRataRata,
            ]);
        } else if ($jenisLaporan == 'layanan') {
            $dataLayanan = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    'tb_layanan.id_layanan',
                    'tb_layanan.nama_layanan',
                    'tb_layanan.jenis',
                    'tb_layanan.harga as harga_layanan',
                    Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    Orders::raw('SUM(tb_orders.berat) as total_berat'),
                    Orders::raw('SUM(tb_orders.jumlah) as total_qty'),
                    Orders::raw('SUM(tb_orders.total) as total_pendapatan'),
                    Orders::raw('(COUNT(tb_orders.id_order) * 100.0 / SUM(COUNT(tb_orders.id_order)) OVER()) as popularitas')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
                ->orderBy('tb_layanan.nama_layanan', 'ASC')
                ->get();

            $allTransaksi = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->count('tb_orders.id_order');

            $allPendapatan = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->sum('tb_orders.total');

            $allRataRata = Layanan::join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->avg('tb_orders.total');

            return response()->json([
                "data" => $dataLayanan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allRataRata" => $allRataRata,
            ]);
        } else if ($jenisLaporan == 'pengeluaran') {
            $dataPengeluaran = DB::table('tb_pengeluaran')
                ->select(
                    'tanggal_pengeluaran',
                    'nama_pengeluaran',
                    'kategori as kategori_pengeluaran',
                    'deskripsi',
                    'jumlah',
                )
                ->whereBetween('tanggal_pengeluaran', [$startDate, $endDate])
                ->orderBy('tanggal_pengeluaran', 'DESC')
                ->get();

            $allPengeluaran = DB::table('tb_pengeluaran')
                ->whereBetween('tanggal_pengeluaran', [$startDate, $endDate])
                ->sum('jumlah');

            $allTransaksi = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->count('tb_orders.id_order');

            $allPendapatan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->sum('tb_orders.total');

            $allRataRata = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->avg('tb_orders.total');

            $allPelanggan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->distinct('tb_orders.id_pelanggan')
                ->count('tb_orders.id_pelanggan');

            return response()->json([
                "data" => $dataPengeluaran,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allPelanggan" => $allPelanggan,
                "allRataRata" => $allRataRata,
                "allPengeluaran" => $allPengeluaran,
            ]);

        } else if ($jenisLaporan == 'keuangan') {
            // Ambil semua tanggal unik dari orders dan pengeluaran
            $dataKeuangan = DB::select("
        SELECT 
            dates.tanggal,
            COALESCE(pendapatan.total, 0) as total_pendapatan,
            COALESCE(pengeluaran.total, 0) as total_pengeluaran
        FROM (
            SELECT DISTINCT DATE(tanggal_masuk) as tanggal 
            FROM tb_orders 
            WHERE tanggal_masuk BETWEEN ? AND ?
            UNION
            SELECT DISTINCT DATE(tanggal_pengeluaran) as tanggal 
            FROM tb_pengeluaran 
            WHERE tanggal_pengeluaran BETWEEN ? AND ?
        ) dates
        LEFT JOIN (
            SELECT DATE(tanggal_masuk) as tanggal, SUM(total) as total
            FROM tb_orders
            WHERE tanggal_masuk BETWEEN ? AND ?
            GROUP BY DATE(tanggal_masuk)
        ) pendapatan ON dates.tanggal = pendapatan.tanggal
        LEFT JOIN (
            SELECT DATE(tanggal_pengeluaran) as tanggal, SUM(jumlah) as total
            FROM tb_pengeluaran
            WHERE tanggal_pengeluaran BETWEEN ? AND ?
            GROUP BY DATE(tanggal_pengeluaran)
        ) pengeluaran ON dates.tanggal = pengeluaran.tanggal
        ORDER BY dates.tanggal ASC
    ", [$startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate]);

            $allPendapatan = DB::table('tb_orders')
                ->whereBetween('tanggal_masuk', [$startDate, $endDate])
                ->sum('total');

            $allPengeluaran = DB::table('tb_pengeluaran')
                ->whereBetween('tanggal_pengeluaran', [$startDate, $endDate])
                ->sum('jumlah');

            $allLabaBersih = $allPendapatan - $allPengeluaran;

            $allTransaksi = Orders::whereBetween('tanggal_masuk', [$startDate, $endDate])->count();

            $allPelanggan = Orders::whereBetween('tanggal_masuk', [$startDate, $endDate])
                ->distinct('id_pelanggan')
                ->count('id_pelanggan');

            $allRataRata = Orders::whereBetween('tanggal_masuk', [$startDate, $endDate])->avg('total');

            return response()->json([
                "data" => $dataKeuangan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allPelanggan" => $allPelanggan,
                "allRataRata" => $allRataRata,
                "allPengeluaran" => $allPengeluaran,
                "allLabaBersih" => $allLabaBersih,
            ]);
            // Default (jaga2)
            return response()->json([
                "columns" => [],
                "data" => []
            ]);
        }
    }
    public function exportPDF(Request $request)
    {
        try {
            $jenisLaporan = $request->jenisLaporan;
            $periodType = $request->periodType;
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            // Set periode
            if ($periodType !== 'custom') {
                switch ($periodType) {
                    case 'today':
                        $startDate = now()->startOfDay();
                        $endDate = now()->endOfDay();
                        break;
                    case 'week':
                        $startDate = now()->startOfWeek();
                        $endDate = now()->endOfWeek();
                        break;
                    case 'month':
                        $startDate = now()->startOfMonth();
                        $endDate = now()->endOfMonth();
                        break;
                    case 'year':
                        $startDate = now()->startOfYear();
                        $endDate = now()->endOfYear();
                        break;
                }
            } else {
                $startDate = Carbon::parse($startDate);
                $endDate = Carbon::parse($endDate);
            }

            if ($jenisLaporan == 'transaksi') {
                $data = DB::table('tb_orders')
                    ->select([
                        'tb_orders.kode_order',
                        'tb_pelanggan.nama',
                        'tb_pelanggan.no_hp',
                        'tb_layanan.nama_layanan',
                        'tb_layanan.jenis',
                        'tb_orders.berat',
                        'tb_orders.jumlah',
                        'tb_orders.total',
                        'tb_orders.status_order',
                        'tb_orders.tanggal_masuk',
                        'tb_orders.tanggal_selesai',
                        'tb_pembayaran.metode',
                        'tb_pembayaran.jumlah as jumlahBayar',
                        'tb_pembayaran.kembalian',
                    ])
                    ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
                    ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                    ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                    ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                    ->orderBy('tb_orders.kode_order', 'DESC')
                    ->get();

                // Konversi ke Carbon untuk blade
                foreach ($data as $item) {
                    $item->tanggal_masuk = Carbon::parse($item->tanggal_masuk);
                    $item->tanggal_selesai = Carbon::parse($item->tanggal_selesai);
                }

                $pdf = Pdf::loadView('reports.pdf.laporan_transaksi', [
                    'data' => $data,
                    'startDate' => $startDate,
                    'endDate' => $endDate
                ]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->download('Laporan_Transaksi_' . date('Ymd_His') . '.pdf');

            } else if ($jenisLaporan == 'pendapatan') {
                $data = DB::table('tb_orders')
                    ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                    ->select(
                        DB::raw('DATE(tb_orders.tanggal_masuk) as tanggal_transaksi'),
                        DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                        DB::raw('SUM(tb_orders.total) as total_pendapatan'),
                        DB::raw('AVG(tb_orders.total) as rata_rata_per_transaksi')
                    )
                    ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                    ->groupBy('tanggal_transaksi')
                    ->orderBy('tb_orders.tanggal_masuk', 'ASC')
                    ->get();

                $pdf = Pdf::loadView('reports.pdf.laporan_pendapatan', [
                    'data' => $data,
                    'startDate' => $startDate,
                    'endDate' => $endDate
                ]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->download('Laporan_Transaksi_' . date('Ymd_His') . '.pdf');

            } else if ($jenisLaporan == 'pelanggan') {
                $data = DB::table('tb_pelanggan')
                    ->join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                    ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                    ->select(
                        'tb_pelanggan.nama as nama_pelanggan',
                        'tb_pelanggan.no_hp',
                        DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                        DB::raw('SUM(tb_orders.total) as total_belanja'),
                        DB::raw('AVG(tb_orders.total) as rata_rata_belanja'),
                        DB::raw('MAX(tb_orders.tanggal_masuk) as tanggal_transaksi_terakhir')
                    )
                    ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                    ->groupBy('tb_pelanggan.nama', 'tb_pelanggan.no_hp')
                    ->orderBy('tb_pelanggan.nama', 'ASC')
                    ->get();

                $pdf = Pdf::loadView('reports.pdf.laporan_pelanggan', [
                    'data' => $data,
                    'startDate' => $startDate,
                    'endDate' => $endDate
                ]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->download('Laporan_Transaksi_' . date('Ymd_His') . '.pdf');

            } else if ($jenisLaporan == 'layanan') {
                $data = DB::table('tb_layanan')
                    ->join('tb_orders', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                    ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                    ->select(
                        'tb_layanan.nama_layanan',
                        'tb_layanan.jenis',
                        'tb_layanan.harga as harga_layanan',
                        DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                        DB::raw('SUM(tb_orders.berat) as total_berat'),
                        DB::raw('SUM(tb_orders.jumlah) as total_qty'),
                        DB::raw('SUM(tb_orders.total) as total_pendapatan')
                    )
                    ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                    ->groupBy('tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
                    ->orderBy('tb_layanan.nama_layanan', 'ASC')
                    ->get();

                $pdf = Pdf::loadView('reports.pdf.laporan_layanan', [
                    'data' => $data,
                    'startDate' => $startDate,
                    'endDate' => $endDate
                ]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->download('Laporan_Transaksi_' . date('Ymd_His') . '.pdf');
            } else if ($jenisLaporan == 'pengeluaran') {
                $data = DB::table('tb_pengeluaran')
                    ->select(
                        'tanggal_pengeluaran',
                        'nama_pengeluaran',
                        'kategori as kategori_pengeluaran',
                        'deskripsi',
                        'jumlah',
                    )
                    ->whereBetween('tanggal_pengeluaran', [$startDate, $endDate])
                    ->orderBy('tanggal_pengeluaran', 'DESC')
                    ->get();

                $totalPengeluaran = $data->sum('jumlah');

                $pdf = Pdf::loadView('reports.pdf.laporan_pengeluaran', [
                    'data' => $data,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'totalPengeluaran' => $totalPengeluaran
                ]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->download('Laporan_Pengeluaran_' . date('Ymd_His') . '.pdf');

            } else if ($jenisLaporan == 'keuangan') {
                $dataKeuangan = DB::select("
        SELECT 
            dates.tanggal,
            COALESCE(pendapatan.total, 0) as total_pendapatan,
            COALESCE(pengeluaran.total, 0) as total_pengeluaran
        FROM (
            SELECT DISTINCT DATE(tanggal_masuk) as tanggal 
            FROM tb_orders 
            WHERE tanggal_masuk BETWEEN ? AND ?
            UNION
            SELECT DISTINCT DATE(tanggal_pengeluaran) as tanggal 
            FROM tb_pengeluaran 
            WHERE tanggal_pengeluaran BETWEEN ? AND ?
        ) dates
        LEFT JOIN (
            SELECT DATE(tanggal_masuk) as tanggal, SUM(total) as total
            FROM tb_orders
            WHERE tanggal_masuk BETWEEN ? AND ?
            GROUP BY DATE(tanggal_masuk)
        ) pendapatan ON dates.tanggal = pendapatan.tanggal
        LEFT JOIN (
            SELECT DATE(tanggal_pengeluaran) as tanggal, SUM(jumlah) as total
            FROM tb_pengeluaran
            WHERE tanggal_pengeluaran BETWEEN ? AND ?
            GROUP BY DATE(tanggal_pengeluaran)
        ) pengeluaran ON dates.tanggal = pengeluaran.tanggal
        ORDER BY dates.tanggal ASC
    ", [$startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate]);

                $allPendapatan = DB::table('tb_orders')
                    ->whereBetween('tanggal_masuk', [$startDate, $endDate])
                    ->sum('total');

                $allPengeluaran = DB::table('tb_pengeluaran')
                    ->whereBetween('tanggal_pengeluaran', [$startDate, $endDate])
                    ->sum('jumlah');

                $allLabaBersih = $allPendapatan - $allPengeluaran;

                $pdf = Pdf::loadView('reports.pdf.laporan_keuangan', [
                    'data' => $dataKeuangan,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'allPendapatan' => $allPendapatan,
                    'allPengeluaran' => $allPengeluaran,
                    'allLabaBersih' => $allLabaBersih
                ]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->download('Laporan_Keuangan_' . date('Ymd_His') . '.pdf');
            }

        } catch (\Exception $e) {
            // Tampilkan error di browser
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function exportExcel(Request $request)
    {
        $jenisLaporan = $request->jenisLaporan;
        $periodType = $request->periodType;
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        if ($periodType !== 'custom') {
            switch ($periodType) {
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate = now()->endOfDay();
                    $periode = 'Hari Ini (' . now()->format('d/m/Y') . ')';
                    break;
                case 'week':
                    $startDate = now()->startOfWeek();
                    $endDate = now()->endOfWeek();
                    $periode = 'Minggu Ini';
                    break;
                case 'month':
                    $startDate = now()->startOfMonth();
                    $endDate = now()->endOfMonth();
                    $periode = 'Bulan Ini';
                    break;
                case 'year':
                    $startDate = now()->startOfYear();
                    $endDate = now()->endOfYear();
                    $periode = 'Tahun Ini';
                    break;
            }
        } else {
            $periode = Carbon::parse($startDate)->format('d/m/Y') . ' - ' . Carbon::parse($endDate)->format('d/m/Y');
        }

        if ($jenisLaporan == 'transaksi') {
            $data = Orders::select([
                'tb_orders.kode_order',
                'tb_pelanggan.nama',
                'tb_pelanggan.no_hp',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_orders.berat',
                'tb_orders.jumlah',
                'tb_orders.total',
                'tb_orders.status_order',
                'tb_pembayaran.metode',
                'tb_pembayaran.jumlah as jumlahBayar',
                'tb_pembayaran.kembalian',
            ])
                ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->orderBy('tb_orders.kode_order', 'DESC')
                ->get();

            $filename = 'Laporan_Transaksi_' . date('Ymd_His') . '.xls';

            return response()
                ->view('reports.excel.laporan_transaksi', compact('data', 'periode'))
                ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Pragma', 'no-cache')
                ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->header('Expires', '0');

        } else if ($jenisLaporan == 'pendapatan') {
            $data = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    Orders::raw('DATE(tb_orders.tanggal_masuk) as tanggal_transaksi'),
                    Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    Orders::raw('SUM(tb_orders.total) as total_pendapatan'),
                    Orders::raw('AVG(tb_orders.total) as rata_rata_per_transaksi')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tanggal_transaksi')
                ->orderBy('tb_orders.tanggal_masuk', 'ASC')
                ->get();

            $filename = 'Laporan_Pendapatan_' . date('Ymd_His') . '.xls';

            return response()
                ->view('reports.excel.laporan_pendapatan', compact('data', 'periode'))
                ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Pragma', 'no-cache')
                ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->header('Expires', '0');

        } else if ($jenisLaporan == 'pelanggan') {
            $data = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    'tb_pelanggan.nama as nama_pelanggan',
                    'tb_pelanggan.no_hp',
                    Orders::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    Orders::raw('SUM(tb_orders.total) as total_belanja'),
                    Orders::raw('AVG(tb_orders.total) as rata_rata_belanja'),
                    Orders::raw('MAX(tb_orders.tanggal_masuk) as tanggal_transaksi_terakhir')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tb_pelanggan.nama', 'tb_pelanggan.no_hp')
                ->orderBy('tb_pelanggan.nama', 'ASC')
                ->get();

            $filename = 'Laporan_Pelanggan_' . date('Ymd_His') . '.xls';

            return response()
                ->view('reports.excel.laporan_pelanggan', compact('data', 'periode'))
                ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Pragma', 'no-cache')
                ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->header('Expires', '0');

                } else if ($jenisLaporan == 'layanan') {

    $data = Orders::join('tb_layanan', 'tb_orders.id_layanan', '=', 'tb_layanan.id_layanan')
        ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
        ->select(
            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
            DB::raw('SUM(tb_orders.berat) as total_berat'),
            DB::raw('SUM(tb_orders.total) as total_pendapatan')
        )
        ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
        ->groupBy('tb_layanan.nama_layanan', 'tb_layanan.jenis')
        ->orderBy('tb_layanan.nama_layanan', 'ASC')
        ->get();

    $filename = 'Laporan_Layanan_' . date('Ymd_His') . '.xls';

    return response()
        ->view('reports.excel.laporan_layanan', compact('data', 'periode'))
        ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
        ->header('Pragma', 'no-cache')
        ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
        ->header('Expires', '0');

        } else if ($jenisLaporan == 'pengeluaran') {
            $data = DB::table('tb_pengeluaran')
                ->select(
                    'tanggal_pengeluaran',
                    'nama_pengeluaran',
                    'kategori as kategori_pengeluaran',
                    'deskripsi',
                    'jumlah'
                )
                ->whereBetween('tanggal_pengeluaran', [$startDate, $endDate])
                ->orderBy('tanggal_pengeluaran', 'DESC')
                ->get();

            $filename = 'Laporan_Pengeluaran_' . date('Ymd_His') . '.xls';

            return response()
                ->view('reports.excel.laporan_pengeluaran', compact('data', 'periode'))
                ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Pragma', 'no-cache')
                ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->header('Expires', '0');

        } else if ($jenisLaporan == 'keuangan') {
            $dataKeuangan = DB::select("
                SELECT 
                    dates.tanggal,
                    COALESCE(pendapatan.total, 0) as total_pendapatan,
                    COALESCE(pengeluaran.total, 0) as total_pengeluaran
                FROM (
                    SELECT DISTINCT DATE(tanggal_masuk) as tanggal 
                    FROM tb_orders 
                    WHERE tanggal_masuk BETWEEN ? AND ?
                    UNION
                    SELECT DISTINCT DATE(tanggal_pengeluaran) as tanggal 
                    FROM tb_pengeluaran 
                    WHERE tanggal_pengeluaran BETWEEN ? AND ?
                ) dates
                LEFT JOIN (
                    SELECT DATE(tanggal_masuk) as tanggal, SUM(total) as total
                    FROM tb_orders
                    WHERE tanggal_masuk BETWEEN ? AND ?
                    GROUP BY DATE(tanggal_masuk)
                ) pendapatan ON dates.tanggal = pendapatan.tanggal
                LEFT JOIN (
                    SELECT DATE(tanggal_pengeluaran) as tanggal, SUM(jumlah) as total
                    FROM tb_pengeluaran
                    WHERE tanggal_pengeluaran BETWEEN ? AND ?
                    GROUP BY DATE(tanggal_pengeluaran)
                ) pengeluaran ON dates.tanggal = pengeluaran.tanggal
                ORDER BY dates.tanggal ASC
            ", [$startDate, $endDate, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate]);

            $data = collect($dataKeuangan); // Convert ke collection

            $filename = 'Laporan_Keuangan_' . date('Ymd_His') . '.xls';

            return response()
                ->view('reports.excel.laporan_keuangan', compact('data', 'periode'))
                ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Pragma', 'no-cache')
                ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                ->header('Expires', '0');
        }
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