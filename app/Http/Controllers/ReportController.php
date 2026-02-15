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
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\LaporanTransaksiExport;
use App\Exports\LaporanPendapatanExport;
use App\Exports\LaporanPelangganExport;
use App\Exports\LaporanLayananExport;
use App\Exports\LaporanPengeluaranExport;
use App\Exports\LaporanKeuanganExport;

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
        
        // Menggunakan Eloquent dengan relasi
        $dataOrder = Orders::with(['pelanggan', 'pembayaran', 'orderItems.layanan'])
            ->whereDate('tanggal_masuk', $currentlyDate)
            ->orderBy('kode_order', 'DESC')
            ->get()
            ->map(function($order) {
                // Ambil semua items
                $items = $order->orderItems;
                $firstItem = $items->first();
                
                // Format layanan untuk multi-services
                $layananText = '';
                if ($items->count() > 1) {
                    $layananText = $firstItem->layanan->nama_layanan . ' +' . ($items->count() - 1) . ' layanan lainnya';
                } else {
                    $layananText = $firstItem->layanan->nama_layanan ?? '-';
                }
                
                return (object)[
                    'id_order' => $order->id_order,
                    'kode_order' => $order->kode_order,
                    'nama' => $order->pelanggan->nama ?? '-',
                    'no_hp' => $order->pelanggan->no_hp ?? '-',
                    'nama_layanan' => $layananText,
                    'layanan_detail' => $items->map(function($item) {
                        return $item->layanan->nama_layanan;
                    })->implode(', '),
                    'jenis' => $firstItem->layanan->jenis ?? '-',
                    'harga' => $firstItem->harga ?? 0,
                    'berat' => $firstItem->qty ?? 0,
                    'jumlah' => $firstItem->qty ?? 0,
                    'total' => $order->total,
                    'status_order' => $order->status_order,
                    'catatan' => $order->catatan,
                    'tanggal_masuk' => $order->tanggal_masuk,
                    'tanggal_selesai' => $order->tanggal_selesai,
                    'metode' => $order->pembayaran->metode ?? '-',
                    'jumlahBayar' => $order->pembayaran->jumlah ?? 0,
                    'kembalian' => $order->pembayaran->kembalian ?? 0,
                    'bukti_transfer' => $order->pembayaran->bukti_transfer ?? null,
                ];
            });
            
        return view('reports.main', compact('dataOrder', 'currentlyDate', 'totalTransaksi', 'totalPendapatan', 'totalPelanggan', 'rataRata', 'id_user_login', 'username_login', 'role_login', 'nama_login'));
    }

    public function generateReport(Request $request)
    {
        $jenisLaporan = $request->jenisLaporan;
        $periodType   = $request->periodType;
        $startDate    = $request->startDate;
        $endDate      = $request->endDate;

        if ($periodType !== 'custom') {
            switch ($periodType) {
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate   = now()->endOfDay();
                    break;

                case 'week':
                    $startDate = now()->startOfWeek();
                    $endDate   = now()->endOfWeek();
                    break;

                case 'month':
                    $startDate = now()->startOfMonth();
                    $endDate   = now()->endOfMonth();
                    break;

                case 'year':
                    $startDate = now()->startOfYear();
                    $endDate   = now()->endOfYear();
                    break;
            }
        }

        // Format jika custom (string → Carbon)
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate   = Carbon::parse($endDate)->endOfDay();

        if ($jenisLaporan == 'transaksi') {
            // Menggunakan Eloquent dengan relasi dan multi-services
            $dataOrders = Orders::with(['pelanggan', 'pembayaran', 'orderItems.layanan'])
                ->whereBetween('tanggal_masuk', [$startDate, $endDate])
                ->orderBy('kode_order', 'DESC')
                ->get()
                ->map(function($order) {
                    $items = $order->orderItems;
                    $firstItem = $items->first();
                    
                    // Format layanan untuk multi-services
                    $layananText = '';
                    if ($items->count() > 1) {
                        $layananText = $firstItem->layanan->nama_layanan . ' +' . ($items->count() - 1) . ' layanan lainnya';
                    } else {
                        $layananText = $firstItem->layanan->nama_layanan ?? '-';
                    }
                    
                    return (object)[
                        'id_order' => $order->id_order,
                        'kode_order' => $order->kode_order,
                        'nama' => $order->pelanggan->nama ?? '-',
                        'no_hp' => $order->pelanggan->no_hp ?? '-',
                        'nama_layanan' => $layananText,
                        'layanan_detail' => $items->map(function($item) {
                            return $item->layanan->nama_layanan;
                        })->implode(', '),
                        'jenis' => $firstItem->layanan->jenis ?? '-',
                        'harga' => $firstItem->harga ?? 0,
                        'berat' => $firstItem->qty ?? 0,
                        'jumlah' => $firstItem->qty ?? 0,
                        'total' => $order->total,
                        'status_order' => $order->status_order,
                        'catatan' => $order->catatan,
                        'tanggal_masuk' => $order->tanggal_masuk,
                        'tanggal_selesai' => $order->tanggal_selesai,
                        'metode' => $order->pembayaran->metode ?? '-',
                        'jumlahBayar' => $order->pembayaran->jumlah ?? 0,
                        'kembalian' => $order->pembayaran->kembalian ?? 0,
                        'bukti_transfer' => $order->pembayaran->bukti_transfer ?? null,
                    ];
                });

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
                    DB::raw('DATE(tb_orders.tanggal_masuk) as tanggal_transaksi'),
                    DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    DB::raw('SUM(tb_orders.total) as total_pendapatan'),
                    DB::raw('AVG(tb_orders.total) as rata_rata_per_transaksi')
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
                "data"    => $dataPendapatan,
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
                    DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    DB::raw('SUM(tb_orders.total) as total_belanja'),
                    DB::raw('AVG(tb_orders.total) as rata_rata_belanja'),
                    DB::raw('MAX(tb_orders.tanggal_masuk) as tanggal_transaksi_terakhir')
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
                "data"    => $dataPelanggan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allPelanggan" => $allPelanggan,
                "allRataRata" => $allRataRata,
            ]);
        } else if ($jenisLaporan == 'layanan') {
            // Laporan layanan menggunakan order_items
            $dataLayanan = Layanan::join('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
                ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    'tb_layanan.id_layanan',
                    'tb_layanan.nama_layanan',
                    'tb_layanan.jenis',
                    'tb_layanan.harga as harga_layanan',
                    DB::raw('COUNT(DISTINCT tb_orders.id_order) as jumlah_transaksi'),
                    DB::raw('SUM(tb_order_items.qty) as total_berat'), // untuk kiloan
                    DB::raw('SUM(tb_order_items.qty) as total_qty'), // untuk satuan
                    DB::raw('SUM(tb_order_items.subtotal) as total_pendapatan'),
                    DB::raw('(COUNT(DISTINCT tb_orders.id_order) * 100.0 / (SELECT COUNT(DISTINCT id_order) FROM tb_orders WHERE tanggal_masuk BETWEEN ? AND ?)) as popularitas')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
                ->orderBy('tb_layanan.nama_layanan', 'ASC')
                ->setBindings([$startDate, $endDate], 'select')
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

            return response()->json([
                "data"    => $dataLayanan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "allTransaksi" => $allTransaksi,
                "allPendapatan" => $allPendapatan,
                "allRataRata" => $allRataRata,
            ]);
        } else if ($jenisLaporan == 'pengeluaran') {
            // Laporan Pengeluaran
            $dataPengeluaran = Pengeluaran::select(
                    'id_pengeluaran',
                    'nama_pengeluaran',
                    'kategori',
                    'jumlah',
                    'tanggal_pengeluaran',
                    'deskripsi',
                    'bukti_pengeluaran'
                )
                ->whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->orderBy('tanggal_pengeluaran', 'DESC')
                ->get();

            $totalPengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->sum('jumlah');

            $pengeluaranPerKategori = Pengeluaran::select(
                    'kategori',
                    DB::raw('SUM(jumlah) as total'),
                    DB::raw('COUNT(*) as jumlah_transaksi')
                )
                ->whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->groupBy('kategori')
                ->get();

            $rataRataPengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->avg('jumlah');

            $allTransaksi = Pengeluaran::whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->count('id_pengeluaran');

            return response()->json([
                "data" => $dataPengeluaran,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                // "totalPengeluaran" => $totalPengeluaran,
                // "pengeluaranPerKategori" => $pengeluaranPerKategori,
                // "rataRataPengeluaran" => $rataRataPengeluaran,

                "allTransaksi" => $allTransaksi,
                // "allPendapatan" => $totalPengeluaran,
                "allRataRata" => $rataRataPengeluaran,
            ]);
        } else if ($jenisLaporan == 'keuangan') {
            // Laporan Keuangan (Pendapatan vs Pengeluaran)
            
            // Total Pendapatan
            $totalPendapatan = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->sum('tb_orders.total');

            // Total Pengeluaran
            $totalPengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->sum('jumlah');

            // Laba Bersih
            $labaBersih = $totalPendapatan - $totalPengeluaran;

            // Data per hari
            $dataKeuangan = DB::table(DB::raw('(
                SELECT DATE(tanggal_masuk) as tanggal, SUM(total) as pendapatan, 0 as pengeluaran
                FROM tb_orders
                WHERE tanggal_masuk BETWEEN ? AND ?
                GROUP BY DATE(tanggal_masuk)
                
                UNION ALL
                
                SELECT tanggal_pengeluaran as tanggal, 0 as pendapatan, SUM(jumlah) as pengeluaran
                FROM tb_pengeluaran
                WHERE tanggal_pengeluaran BETWEEN ? AND ? AND status = "aktif"
                GROUP BY tanggal_pengeluaran
            ) as combined'))
            ->select(
                'tanggal',
                DB::raw('SUM(pendapatan) as total_pendapatan'),
                DB::raw('SUM(pengeluaran) as total_pengeluaran'),
                DB::raw('SUM(pendapatan) - SUM(pengeluaran) as laba_bersih')
            )
            ->setBindings([
                $startDate, $endDate,
                $startDate->format('Y-m-d'), $endDate->format('Y-m-d')
            ])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

            // Pengeluaran per kategori
            $pengeluaranPerKategori = Pengeluaran::select(
                    'kategori',
                    DB::raw('SUM(jumlah) as total')
                )
                ->whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->groupBy('kategori')
                ->get();

            // Jumlah transaksi
            $jumlahTransaksi = Orders::whereBetween('tanggal_masuk', [$startDate, $endDate])->count();
            $jumlahPengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->where('status', 'aktif')
                ->count();

            return response()->json([
                "data" => $dataKeuangan,
                "tanggal_awal" => $startDate,
                "tanggal_akhir" => $endDate,
                "totalPendapatan" => $totalPendapatan,
                "totalPengeluaran" => $totalPengeluaran,
                "labaBersih" => $labaBersih,
                "pengeluaranPerKategori" => $pengeluaranPerKategori,
                "jumlahTransaksi" => $jumlahTransaksi,
                "jumlahPengeluaran" => $jumlahPengeluaran,

                "allTransaksi" => $jumlahTransaksi,
                "allPendapatan" => $labaBersih,
                "allRataRata" => $labaBersih / ($jumlahTransaksi > 0 ? $jumlahTransaksi : 1),
            ]);
        }

        // Default (jaga2)
        return response()->json([
            "columns" => [],
            "data" => []
        ]);
    }

    public function exportPDF(Request $request)
    {
        $jenisLaporan = $request->jenisLaporan;
        $periodType   = $request->periodType;
        $startDate    = $request->startDate;
        $endDate      = $request->endDate;

        if ($periodType !== 'custom') {
            switch ($periodType) {
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate   = now()->endOfDay();
                    break;

                case 'week':
                    $startDate = now()->startOfWeek();
                    $endDate   = now()->endOfWeek();
                    break;

                case 'month':
                    $startDate = now()->startOfMonth();
                    $endDate   = now()->endOfMonth();
                    break;

                case 'year':
                    $startDate = now()->startOfYear();
                    $endDate   = now()->endOfYear();
                    break;
            }
        }

        if ($jenisLaporan == 'transaksi') {
            $data = Orders::with(['pelanggan', 'pembayaran', 'orderItems.layanan'])
                ->whereBetween('tanggal_masuk', [$startDate, $endDate])
                ->orderBy('kode_order', 'DESC')
                ->get()
                ->map(function($order) {
                    $items = $order->orderItems;
                    $firstItem = $items->first();
                    
                    // Format layanan untuk multi-services
                    $layananText = '';
                    if ($items->count() > 1) {
                        $layananText = $firstItem->layanan->nama_layanan . ' +' . ($items->count() - 1) . ' layanan lainnya';
                    } else {
                        $layananText = $firstItem->layanan->nama_layanan ?? '-';
                    }
                    
                    return (object)[
                        'id_order' => $order->id_order,
                        'kode_order' => $order->kode_order,
                        'nama' => $order->pelanggan->nama ?? '-',
                        'no_hp' => $order->pelanggan->no_hp ?? '-',
                        'nama_layanan' => $layananText,
                        'layanan_detail' => $items->map(function($item) {
                            return $item->layanan->nama_layanan;
                        })->implode(', '),
                        'jenis' => $firstItem->layanan->jenis ?? '-',
                        'harga' => $firstItem->harga ?? 0,
                        'berat' => $firstItem->qty ?? 0,
                        'jumlah' => $firstItem->qty ?? 0,
                        'total' => $order->total,
                        'status_order' => $order->status_order,
                        'catatan' => $order->catatan,
                        'tanggal_masuk' => $order->tanggal_masuk,
                        'tanggal_selesai' => $order->tanggal_selesai,
                        'metode' => $order->pembayaran->metode ?? '-',
                        'jumlahBayar' => $order->pembayaran->jumlah ?? 0,
                        'kembalian' => $order->pembayaran->kembalian ?? 0,
                        'bukti_transfer' => $order->pembayaran->bukti_transfer ?? null,
                    ];
                });

            $pdf = Pdf::loadView('reports.pdf.laporan_transaksi', compact('data', 'startDate', 'endDate', 'jenisLaporan'))
            ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_transaksi.pdf');

        } else if ($jenisLaporan == 'pendapatan') {
            $data = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
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

            $pdf = Pdf::loadView('reports.pdf.laporan_pendapatan', compact('data', 'startDate', 'endDate', 'jenisLaporan'))
            ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_pendapatan.pdf');

        } else if ($jenisLaporan == 'pelanggan') {
            $data = Pelanggan::join('tb_orders', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    'tb_pelanggan.id_pelanggan',
                    'tb_pelanggan.nama as nama_pelanggan',
                    'tb_pelanggan.no_hp',
                    DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                    DB::raw('SUM(tb_orders.total) as total_belanja'),
                    DB::raw('AVG(tb_orders.total) as rata_rata_belanja'),
                    DB::raw('MAX(tb_orders.tanggal_masuk) as tanggal_transaksi_terakhir')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tb_pelanggan.id_pelanggan', 'tb_pelanggan.nama', 'tb_pelanggan.no_hp')
                ->orderBy('tb_pelanggan.nama', 'ASC')
                ->get();

            $pdf = Pdf::loadView('reports.pdf.laporan_pelanggan', compact('data', 'startDate', 'endDate', 'jenisLaporan'))
            ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_pelanggan.pdf');
        } else if ($jenisLaporan == 'layanan') {
            $data = Layanan::join('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
                ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
                ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
                ->select(
                    'tb_layanan.id_layanan',
                    'tb_layanan.nama_layanan',
                    'tb_layanan.jenis',
                    'tb_layanan.harga as harga_layanan',
                    DB::raw('COUNT(DISTINCT tb_orders.id_order) as jumlah_transaksi'),
                    DB::raw('SUM(tb_order_items.qty) as total_berat'),
                    DB::raw('SUM(tb_order_items.qty) as total_qty'),
                    DB::raw('SUM(tb_order_items.subtotal) as total_pendapatan'),
                    DB::raw('(COUNT(DISTINCT tb_orders.id_order) * 100.0 / (SELECT COUNT(DISTINCT id_order) FROM tb_orders WHERE tanggal_masuk BETWEEN ? AND ?)) as popularitas')
                )
                ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
                ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga')
                ->orderBy('tb_layanan.nama_layanan', 'ASC')
                ->setBindings([$startDate, $endDate], 'select')
                ->get();

            $pdf = Pdf::loadView('reports.pdf.laporan_layanan', compact('data', 'startDate', 'endDate', 'jenisLaporan'))
            ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_layanan.pdf');
        } else if ($jenisLaporan == 'pengeluaran') {

            $dataPengeluaran = Pengeluaran::select(
                    'id_pengeluaran',
                    'nama_pengeluaran',
                    'kategori',
                    'jumlah',
                    'tanggal_pengeluaran',
                    'deskripsi'
                )
                ->whereBetween('tanggal_pengeluaran', [
                    Carbon::parse($startDate)->format('Y-m-d'),
                    Carbon::parse($endDate)->format('Y-m-d')
                ])
                ->where('status', 'aktif')
                ->orderBy('tanggal_pengeluaran', 'DESC')
                ->get();

            $totalPengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [
                    Carbon::parse($startDate)->format('Y-m-d'),
                    Carbon::parse($endDate)->format('Y-m-d')
                ])
                ->where('status', 'aktif')
                ->sum('jumlah');

            $periode = Carbon::parse($startDate)->format('d/m/Y') . ' s/d ' .
                    Carbon::parse($endDate)->format('d/m/Y');

            $pdf = Pdf::loadView(
                'reports.pdf.laporan_pengeluaran',
                [
                    'data' => $dataPengeluaran,
                    'totalPengeluaran' => $totalPengeluaran,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'periode' => $periode,
                ]
            )->setPaper('a4', 'landscape');

            return $pdf->download('laporan_pengeluaran.pdf');
        } else if ($jenisLaporan == 'keuangan') {

            $start = Carbon::parse($startDate)->startOfDay();
            $end   = Carbon::parse($endDate)->endOfDay();

            $dataKeuangan = DB::table(DB::raw('(
                SELECT DATE(tanggal_masuk) as tanggal, SUM(total) as pendapatan, 0 as pengeluaran
                FROM tb_orders
                WHERE tanggal_masuk BETWEEN ? AND ?
                GROUP BY DATE(tanggal_masuk)

                UNION ALL

                SELECT tanggal_pengeluaran as tanggal, 0 as pendapatan, SUM(jumlah) as pengeluaran
                FROM tb_pengeluaran
                WHERE tanggal_pengeluaran BETWEEN ? AND ?
                AND status = "aktif"
                GROUP BY tanggal_pengeluaran
            ) as combined'))
            ->select(
                'tanggal',
                DB::raw('SUM(pendapatan) as total_pendapatan'),
                DB::raw('SUM(pengeluaran) as total_pengeluaran'),
                DB::raw('SUM(pendapatan) - SUM(pengeluaran) as laba_bersih')
            )
            ->setBindings([
                $start, $end,
                $start->format('Y-m-d'), $end->format('Y-m-d')
            ])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

            $totalPendapatan = Orders::whereBetween('tanggal_masuk', [$start, $end])
                ->sum('total');

            $totalPengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [
                    $start->format('Y-m-d'),
                    $end->format('Y-m-d')
                ])
                ->where('status', 'aktif')
                ->sum('jumlah');

            $labaBersih = $totalPendapatan - $totalPengeluaran;

            $periode = $start->format('d/m/Y') . ' s/d ' . $end->format('d/m/Y');

            $pdf = Pdf::loadView(
                'reports.pdf.laporan_keuangan',
                [
                    'data'     => $dataKeuangan,
                    'totalPendapatan'  => $totalPendapatan,
                    'totalPengeluaran' => $totalPengeluaran,
                    'startDate' => $start,
                    'endDate' => $end,
                    'labaBersih'       => $labaBersih,
                    'periode'          => $periode,
                ]
            )->setPaper('a4', 'landscape');

            return $pdf->download('laporan_keuangan.pdf');
        }

    }


    public function exportExcel(Request $request)
{
    $jenisLaporan = $request->jenisLaporan;
    $periodType   = $request->periodType;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;

    if ($periodType !== 'custom') {
        switch ($periodType) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate   = now()->endOfDay();
                break;
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate   = now()->endOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate   = now()->endOfMonth();
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate   = now()->endOfYear();
                break;
        }
    }

    $startDate = Carbon::parse($startDate)->startOfDay();
    $endDate   = Carbon::parse($endDate)->endOfDay();

    // ================= TRANSAKSI =================
    if ($jenisLaporan === 'transaksi') {
        $data = Orders::with(['pelanggan', 'pembayaran', 'orderItems.layanan'])
            ->whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->orderBy('kode_order', 'DESC')
            ->get();

        return Excel::download(
            new LaporanTransaksiExport($data),
            'laporan-transaksi-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    // ================= PENDAPATAN =================
    if ($jenisLaporan === 'pendapatan') {
        $data = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                DB::raw('DATE(tb_orders.tanggal_masuk) as tanggal'),
                DB::raw('COUNT(tb_orders.id_order) as jumlah_transaksi'),
                DB::raw('SUM(tb_orders.total) as total_pendapatan'),
                DB::raw('AVG(tb_orders.total) as rata_rata')
            )
            ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        return Excel::download(
            new LaporanPendapatanExport($data),
            'laporan-pendapatan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    // ================= PELANGGAN =================
    if ($jenisLaporan === 'pelanggan') {
        $data = Pelanggan::orderBy('created_at', 'DESC')->get();

        return Excel::download(
            new LaporanPelangganExport($data),
            'laporan-pelanggan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    // ================= LAYANAN =================
    if ($jenisLaporan === 'layanan') {
        $data = Layanan::orderBy('nama_layanan', 'ASC')->get();

        return Excel::download(
            new LaporanLayananExport($data),
            'laporan-layanan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    // ================= PENGELUARAN =================
    if ($jenisLaporan === 'pengeluaran') {
        $data = Pengeluaran::whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'DESC')
            ->get();

        return Excel::download(
            new LaporanPengeluaranExport($data),
            'laporan-pengeluaran-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    // ================= KEUANGAN =================
    if ($jenisLaporan === 'keuangan') {
        $data = Orders::join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_orders.kode_order',
                'tb_orders.tanggal_masuk',
                'tb_orders.total',
                'tb_pembayaran.metode',
                'tb_pembayaran.status'
            )
            ->whereBetween('tb_orders.tanggal_masuk', [$startDate, $endDate])
            ->orderBy('tb_orders.tanggal_masuk', 'DESC')
            ->get();

        return Excel::download(
            new LaporanKeuanganExport($data),
            'laporan-keuangan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    return back()->with('error', 'Jenis laporan tidak valid');
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