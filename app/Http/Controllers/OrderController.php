<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Layanan;
use App\Models\Orders;
use App\Models\Pelanggan;
use App\Models\Users;
use App\Models\Pembayaran;
use App\Models\OrderStatusLog;
use App\Models\OrderItems;

class OrderController extends Controller
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
        $currentlyDate = Carbon::now()->format('Y-m-d');
        
        // Query untuk mendapatkan orders dengan total items
        $dataOrder = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            DB::raw('COUNT(tb_order_items.id_order_item) as jumlah_layanan')
        ])
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->join('tb_order_items', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
        ->groupBy('tb_orders.id_order', 
            'tb_orders.kode_order',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp'
        )
        ->orderBy('tb_orders.tanggal_masuk', 'DESC')
        ->paginate(10);

        $totalOrder = DB::table('tb_order_items')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->distinct('tb_orders.id_order')
            ->count('tb_orders.id_order');

        $totalMenunggu = DB::table('tb_order_items')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->where('tb_orders.status_order', 'menunggu')
            ->distinct('tb_orders.id_order')
            ->count('tb_orders.id_order');

        $totalDiproses = DB::table('tb_order_items')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->whereIn('tb_orders.status_order', ['diproses', 'dicuci', 'disetrika'])
            ->distinct('tb_orders.id_order')
            ->count('tb_orders.id_order');

        $totalReady = DB::table('tb_order_items')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->where('tb_orders.status_order', 'ready')
            ->distinct('tb_orders.id_order')
            ->count('tb_orders.id_order');

        $totalDiambil = DB::table('tb_order_items')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->where('tb_orders.status_order', 'diambil')
            ->distinct('tb_orders.id_order')
            ->count('tb_orders.id_order');

        return view('orders.main', compact('dataOrder', 'currentlyDate', 'totalOrder', 'totalMenunggu', 'totalDiproses', 'totalReady', 'totalDiambil','id_user_login', 'username_login', 'role_login', 'nama_login' ));
    }

    public function search(Request $request)
    {
        $order = $request->get('order', '');
        $status = $request->get('status', '');
        $tanggal = $request->get('tanggal', '');

        $dataOrders = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            DB::raw('COUNT(tb_order_items.id_order_item) as jumlah_layanan')
        ])
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->join('tb_order_items', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
        ->groupBy('tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp'
        );

        if ($order) {
            $dataOrders->where(function($q) use ($order) {
                $q->where('tb_orders.kode_order', 'LIKE', "%{$order}%")
                ->orWhere('tb_pelanggan.nama', 'LIKE', "%{$order}%");
            });
        }

        if ($status) {
            $dataOrders->where('tb_orders.status_order', $status);
        }

        if ($tanggal) {
            $dataOrders->whereDate('tb_orders.tanggal_masuk', $tanggal);
        }

        $dataOrders = $dataOrders->orderBy('tb_orders.tanggal_masuk', 'DESC')->paginate(10);

        return response()->json([
            'data' => $dataOrders->items(),
            'current_page' => $dataOrders->currentPage(),
            'last_page' => $dataOrders->lastPage(),
            'per_page' => $dataOrders->perPage(),
            'total' => $dataOrders->total(),
        ]);
    }

    public function createPelanggan(){
        return view('orders.createPelanggan');
    }

    public function storePelanggan(Request $request){
        try{
            $validated = $request->validate([
                'nama' => 'required|string|max:100',
                'no_hp' => 'required|string|max:20',
                'email' => 'required|email|max:100',
                'alamat' => 'required|string|max:255',
            ]);

            $lastIdTransaksiPelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->first();

            if ($lastIdTransaksiPelanggan) {
                $lastNumber = (int)substr($lastIdTransaksiPelanggan->id_pelanggan, 3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'PLG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $pelangganBaru = Pelanggan::create([
                'id_pelanggan' => $newId,
                'nama' => $validated['nama'],
                'no_hp' => $validated['no_hp'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
            ]);

            return response()->json([
                'success' => true,
                'data' => $pelangganBaru
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataPelanggan = Pelanggan::select([
            'tb_pelanggan.id_pelanggan',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.email',
            'tb_pelanggan.alamat',
        ])->orderBy('tb_pelanggan.nama')
        ->get();

        $dataLayanan = Layanan::select([
            'tb_layanan.id_layanan',
            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',
            'tb_layanan.durasi',
            'tb_layanan.status',
        ])->orderBy('tb_layanan.nama_layanan')
        ->where('status', 'Aktif')
        ->get();

        $currentlyDate = Carbon::now()->format('Y-m-d');

        $countToday = Orders::whereDate('tanggal_masuk', $currentlyDate)->count();
        $orderNumber = $countToday + 1;
        $orderNumberFormatted = str_pad($orderNumber, 3, '0', STR_PAD_LEFT);
        $kodeOrder = 'ORD-' . Carbon::now()->format('Ymd') . '-' . $orderNumberFormatted;

        return view('orders.create', compact('dataPelanggan', 'dataLayanan', 'currentlyDate', 'kodeOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $request->merge([
                'totalBayar' => str_replace('.', '', $request->totalBayar),
                'kembalian' => str_replace('.', '', $request->kembalian),
            ]);

            $validated = $request->validate([
                'kode_order' => 'required|string|max:50',
                'nama_pelanggan' => 'required|string|max:10',
                'tanggal_masuk' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'totalBayar' => 'required|numeric|min:0',
                'kembalian' => 'required|numeric|min:0',
                'metode' => 'required|string|max:10',
            ]);

            $id_user_login = Session::get('id_user');
            $now = now('Asia/Jakarta');

            $tanggalMasuk = Carbon::parse($validated['tanggal_masuk'])->setTimeFrom($now);
            $tanggalSelesai = Carbon::parse($validated['tanggal_selesai'])->setTimeFrom($now);

            // Generate ID Order
            $lastIdTransaksiOrders = Orders::orderBy('id_order', 'desc')->first();
            if ($lastIdTransaksiOrders) {
                $lastNumber = (int)substr($lastIdTransaksiOrders->id_order, 3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $newId = 'ORD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            // Hitung total dari items
            $totalOrder = 0;
            if ($request->has('items') && is_array($request->items)) {
                foreach ($request->items as $item) {
                    $totalOrder += floatval(str_replace('.', '', $item['subtotal']));
                }
            }

            // Create Order
            Orders::create([
                'id_order' => $newId,
                'kode_order' => $validated['kode_order'],
                'id_pelanggan' => $validated['nama_pelanggan'],
                'total' => $totalOrder,
                'status_order' => 'menunggu',
                'tanggal_masuk' => $tanggalMasuk,
                'tanggal_selesai' => $tanggalSelesai,
            ]);

            // Create Order Items
            if ($request->has('items') && is_array($request->items)) {
                foreach ($request->items as $index => $item) {
                    $lastOrderItem = DB::table('tb_order_items')->orderBy('id_order_item', 'desc')->first();
                    if ($lastOrderItem) {
                        $lastNumberItem = (int)substr($lastOrderItem->id_order_item, 3);
                        $newNumberItem = $lastNumberItem + 1;
                    } else {
                        $newNumberItem = 1;
                    }
                    $newIdItem = 'ITM' . str_pad($newNumberItem, 3, '0', STR_PAD_LEFT);

                    DB::table('tb_order_items')->insert([
                        'id_order_item' => $newIdItem,
                        'id_order' => $newId,
                        'id_layanan' => $item['id_layanan'],
                        'qty' => intval($item['qty']),
                        'harga' => floatval(str_replace('.', '', $item['harga'])),
                        'subtotal' => floatval(str_replace('.', '', $item['subtotal'])),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            // Create Pembayaran
            $lastIdTransaksiPembayaran = Pembayaran::orderBy('id_pembayaran', 'desc')->first();
            if ($lastIdTransaksiPembayaran) {
                $lastNumberPay = (int)substr($lastIdTransaksiPembayaran->id_pembayaran, 3);
                $newNumberPay = $lastNumberPay + 1;
            } else {
                $newNumberPay = 1;
            }
            $newIdPay = 'PAY' . str_pad($newNumberPay, 3, '0', STR_PAD_LEFT);

            Pembayaran::create([
                'id_pembayaran' => $newIdPay,
                'id_order' => $newId,
                'metode' => $validated['metode'],
                'jumlah' => $validated['totalBayar'],
                'bukti_transfer' => null,
                'kembalian' => $validated['kembalian'],
                'tanggal_bayar' => $tanggalMasuk,
            ]);

            // Create Status Log
            $lastIdTransaksiLog = OrderStatusLog::orderBy('id_order_status_log', 'desc')->first();
            if ($lastIdTransaksiLog) {
                $lastNumberLog = (int)substr($lastIdTransaksiLog->id_order_status_log, 3);
                $newNumberLog = $lastNumberLog + 1;
            } else {
                $newNumberLog = 1;
            }
            $newIdLog = 'LOG' . str_pad($newNumberLog, 3, '0', STR_PAD_LEFT);

            OrderStatusLog::create([
                'id_order_status_log' => $newIdLog,
                'id_order' => $newId,
                'status' => 'menunggu',
                'id_user' => $id_user_login,
                'tanggal_ubah' => $tanggalMasuk,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Order berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
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
    public function edit(string $id_order)
    {
        $dataOrder = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.id_pelanggan',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pembayaran.id_pembayaran',
            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
        ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->where('tb_orders.id_order', $id_order)
        ->first();

        // Get order items
        $orderItems = DB::table('tb_order_items')
            ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->where('tb_order_items.id_order', $id_order)
            ->select([
                'tb_order_items.*',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis'
            ])
            ->get();

        $dataPelanggan = Pelanggan::select([
            'tb_pelanggan.id_pelanggan',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.email',
            'tb_pelanggan.alamat',
        ])->orderBy('tb_pelanggan.nama')
        ->get();

        $dataLayanan = Layanan::select([
            'tb_layanan.id_layanan',
            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',
            'tb_layanan.durasi',
            'tb_layanan.status',
        ])->orderBy('tb_layanan.nama_layanan')
        ->get();

        $currentlyDate = Carbon::now()->format('Y-m-d');

        return view('orders.edit', compact('dataOrder', 'orderItems', 'dataPelanggan', 'dataLayanan', 'currentlyDate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_order, string $id_pembayaran)
    {
        try{
            DB::beginTransaction();

            $request->merge([
                'totalBayar' => str_replace('.', '', $request->totalBayar),
                'kembalian' => str_replace('.', '', $request->kembalian),
            ]);

            $validated = $request->validate([
                'tanggal_masuk' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'totalBayar' => 'required|numeric|min:0',
                'kembalian' => 'required|numeric|min:0',
                'metode' => 'required|string|max:10',
            ]);

            $now = now('Asia/Jakarta');
            $tanggalMasuk = Carbon::parse($validated['tanggal_masuk'])->setTimeFrom($now);
            $tanggalSelesai = Carbon::parse($validated['tanggal_selesai'])->setTimeFrom($now);

            // Update items jika ada
            $totalOrder = 0;
            if ($request->has('items') && is_array($request->items)) {
                // Delete existing items
                DB::table('tb_order_items')->where('id_order', $id_order)->delete();

                // Insert new items
                foreach ($request->items as $item) {
                    $lastOrderItem = DB::table('tb_order_items')->orderBy('id_order_item', 'desc')->first();
                    if ($lastOrderItem) {
                        $lastNumberItem = (int)substr($lastOrderItem->id_order_item, 3);
                        $newNumberItem = $lastNumberItem + 1;
                    } else {
                        $newNumberItem = 1;
                    }
                    $newIdItem = 'ITM' . str_pad($newNumberItem, 3, '0', STR_PAD_LEFT);

                    $subtotal = floatval(str_replace('.', '', $item['subtotal']));
                    $totalOrder += $subtotal;

                    DB::table('tb_order_items')->insert([
                        'id_order_item' => $newIdItem,
                        'id_order' => $id_order,
                        'id_layanan' => $item['id_layanan'],
                        'qty' => intval($item['qty']),
                        'harga' => floatval(str_replace('.', '', $item['harga'])),
                        'subtotal' => $subtotal,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            Orders::where('id_order', $id_order)->update([
                'total' => $totalOrder,
                'tanggal_masuk' => $tanggalMasuk,
                'tanggal_selesai' => $tanggalSelesai,
            ]);

            Pembayaran::where('id_pembayaran', $id_pembayaran)->update([
                'metode' => $validated['metode'],
                'jumlah' => $validated['totalBayar'],
                'bukti_transfer' => null,
                'kembalian' => $validated['kembalian'],
                'tanggal_bayar' => $tanggalMasuk,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Order berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function detail(string $id_order)
    {
        $dataOrder = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.id_pelanggan',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.alamat',
            'tb_pelanggan.email',
            'tb_pembayaran.id_pembayaran',
            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
        ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->where('tb_orders.id_order', $id_order)
        ->first();

        // Get order items dengan detail layanan
        $orderItems = DB::table('tb_order_items')
            ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->where('tb_order_items.id_order', $id_order)
            ->select([
                'tb_order_items.id_order_item',
                'tb_order_items.qty',
                'tb_order_items.harga',
                'tb_order_items.subtotal',
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis'
            ])
            ->get();

        $dataOrderStatusLogs = OrderstatusLog::select([
            'tb_order_status_logs.id_order_status_log',
            'tb_order_status_logs.id_order',
            'tb_order_status_logs.status',
            'tb_order_status_logs.tanggal_ubah',
            'tb_users.nama'
        ])
        ->join('tb_orders', 'tb_order_status_logs.id_order', '=', 'tb_orders.id_order')
        ->join('tb_users', 'tb_order_status_logs.id_user', '=', 'tb_users.id_user')
        ->where('tb_order_status_logs.id_order', $id_order)
        ->orderByDesc('tb_order_status_logs.id_order_status_log')
        ->get();

        $currentlyDate = Carbon::now()->format('Y-m-d');
        $role_login = Session::get('role');

        return view('orders.detail', compact('dataOrder', 'orderItems', 'currentlyDate', 'dataOrderStatusLogs', 'role_login'));
    }

    public function cancel(Request $request, string $id_order)
    {
        $id_user_login = Session::get('id_user');
        Orders::where('id_order', $id_order)->update([
            'status_order' => 'dibatalkan',
        ]);

        $lastIdTransaksiLog = OrderStatusLog::orderBy('id_order_status_log', 'desc')->first();

        if ($lastIdTransaksiLog) {
            $lastNumberLog = (int)substr($lastIdTransaksiLog->id_order_status_log, 3);
            $newNumberLog = $lastNumberLog + 1;
        } else {
            $newNumberLog = 1;
        }

        $newIdLog = 'LOG' . str_pad($newNumberLog, 3, '0', STR_PAD_LEFT);
        $now = now('Asia/Jakarta');
        $currentlyDate = Carbon::now()->format('Y-m-d');

        $tanggalMasuk = Carbon::parse($currentlyDate)->setTimeFrom($now);

        OrderStatusLog::create([
            'id_order_status_log' => $newIdLog,
            'id_order' => $id_order,
            'status' => 'dibatalkan',
            'id_user' => $id_user_login,
            'tanggal_ubah' => $tanggalMasuk,
        ]);

        return redirect()->back();
    }

    public function change(Request $request, string $id_order)
    {
        $id_user_login = Session::get('id_user');
        $validated = $request->validate([
            'status_order' => 'required|string|max:50',
        ]);

        Orders::where('id_order', $id_order)->update([
            'status_order' => $validated['status_order'],
        ]);

        $lastIdTransaksiLog = OrderStatusLog::orderBy('id_order_status_log', 'desc')->first();

        if ($lastIdTransaksiLog) {
            $lastNumberLog = (int)substr($lastIdTransaksiLog->id_order_status_log, 3);
            $newNumberLog = $lastNumberLog + 1;
        } else {
            $newNumberLog = 1;
        }

        $newIdLog = 'LOG' . str_pad($newNumberLog, 3, '0', STR_PAD_LEFT);
        $now = now('Asia/Jakarta');
        $currentlyDate = Carbon::now()->format('Y-m-d');

        $tanggalMasuk = Carbon::parse($currentlyDate)->setTimeFrom($now);

        OrderStatusLog::create([
            'id_order_status_log' => $newIdLog,
            'id_order' => $id_order,
            'status' => $validated['status_order'],
            'id_user' => $id_user_login,
            'tanggal_ubah' => $tanggalMasuk,
        ]);

        return redirect()->back();
    }

    public function printStruk(string $id_order)
    {
        $dataOrder = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.id_pelanggan',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.alamat',
            'tb_pelanggan.email',
            'tb_pembayaran.id_pembayaran',
            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
        ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->where('tb_orders.id_order', $id_order)
        ->first();

        // Get order items
        $orderItems = DB::table('tb_order_items')
            ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->where('tb_order_items.id_order', $id_order)
            ->select([
                'tb_order_items.qty',
                'tb_order_items.harga',
                'tb_order_items.subtotal',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis'
            ])
            ->get();

        $dateNow = Carbon::now()->format('Y-m-d');
        $now = now('Asia/Jakarta');

        $currentlyDate = Carbon::parse($dateNow)->setTimeFrom($now);

        return view('orders.struk', compact('dataOrder', 'orderItems', 'currentlyDate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}