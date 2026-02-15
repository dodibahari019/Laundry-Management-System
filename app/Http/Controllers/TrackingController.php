<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderStatusLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     * Display tracking page (matching landing page style)
     */
    public function index(Request $request)
    {
        $kodeOrder = $request->query('nota');
        $order = null;
        $statusHistory = null;

        if ($kodeOrder) {
            // Find order by kode_order
            $order = Orders::with(['pelanggan', 'orderItems.layanan', 'pembayaran', 'orderLocations'])
                ->where('kode_order', $kodeOrder)
                ->first();

            if ($order) {
                // Get status history logs
                $statusHistory = OrderStatusLog::where('id_order', $order->id_order)
                    ->orderBy('tanggal_ubah', 'desc')
                    ->get();
            }
        }

        $top4Layanan = Layanan::join('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            // ->where('tb_pembayaran.status', 'settlement')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();

        return view('trackingPage', compact('order', 'statusHistory', 'kodeOrder', 'top4Layanan'));
    }

    /**
     * Check tracking via AJAX (for landing page tracking section)
     */
    public function check(Request $request)
    {
        $request->validate([
            'nota' => 'required|string'
        ]);

        $order = Orders::with(['pelanggan', 'orderItems.layanan'])
            ->where('kode_order', $request->nota)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        // Get first service name
        $firstService = $order->orderItems->first();
        
        // Get status logs
        $statusLogs = OrderStatusLog::where('id_order', $order->id_order)
            ->orderBy('tanggal_ubah', 'desc')
            ->get();

        // Prepare response data
        $responseData = [
            'order' => [
                'kode_order' => $order->kode_order,
                'status_order' => $order->status_order,
                'tanggal_masuk' => $order->tanggal_masuk,
                'tanggal_selesai' => $order->tanggal_selesai,
                'nama' => $order->pelanggan->nama,
                'nama_layanan' => $firstService ? $firstService->layanan->nama_layanan : 'N/A',
                'jenis' => $firstService ? $firstService->layanan->jenis : 'N/A',
                'catatan' => $order->catatan,
            ],
            'statusLogs' => $statusLogs->map(function($log) {
                return [
                    'status' => $log->status,
                    'tanggal_ubah' => $log->tanggal_ubah,
                ];
            })
        ];

        return response()->json([
            'success' => true,
            'data' => $responseData
        ]);
    }

    /**
     * API endpoint to check order status (for real-time updates)
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'kode_order' => 'required|string'
        ]);

        $order = Orders::with(['pelanggan', 'orderItems.layanan', 'pembayaran'])
            ->where('kode_order', $request->kode_order)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        $statusHistory = OrderStatusLog::where('id_order', $order->id_order)
            ->orderBy('tanggal_ubah', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'order' => $order,
                'status_history' => $statusHistory,
                'progress' => $this->calculateProgress($order->status_order)
            ]
        ]);
    }

    /**
     * Calculate progress percentage based on order status
     */
    private function calculateProgress($status)
    {
        $progressMap = [
            'menunggu' => 10,
            'diproses' => 30,
            'dicuci' => 50,
            'disetrika' => 70,
            'ready' => 90,
            'diambil' => 100,
            'dibatalkan' => 0
        ];

        return $progressMap[$status] ?? 0;
    }

    /**
     * Track order with QR code or barcode
     */
    public function trackWithCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $order = Orders::where('kode_order', $request->code)
            ->orWhere('id_order', $request->code)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Kode pesanan tidak valid'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'redirect' => '/tracking?nota=' . $order->kode_order
        ]);
    }
}