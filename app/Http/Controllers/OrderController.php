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
        ])
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->orderBy('tb_orders.kode_order', 'DESC')
        ->paginate(10);

        $totalOrder = Orders::count();
        $totalMenunggu = Orders::where('status_order', 'menunggu')->count();
        // $totalDiproses = Orders::where('status_order', 'diproses')->count();
        $totalDiproses = Orders::whereIn('status_order', ['diproses', 'dicuci', 'disetrika'])->count();
        $totalReady = Orders::where('status_order', 'ready')->count();
        $totalDiambil = Orders::where('status_order', 'diambil')->count();
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
        ])
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan');

        if ($order) {
            $dataOrders->where(function($q) use ($order) {
                $q->where('tb_orders.kode_order', 'LIKE', "%{$order}%")
                ->orWhere('tb_pelanggan.nama', 'LIKE', "%{$order}%")
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

            // Cari ID terakhir
            $lastIdTransaksiPelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->first();

            if ($lastIdTransaksiPelanggan) {
                $lastNumber = (int)substr($lastIdTransaksiPelanggan->id_pelanggan, 3); // Ambil angka dari 'SUP001'
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

            // return redirect()->back();
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

        // Hitung jumlah order yang sudah dibuat hari ini
        $countToday = Orders::whereDate('tanggal_masuk', $currentlyDate)->count();

        // Tambahkan 1 untuk order baru
        $orderNumber = $countToday + 1;

        // Buat format 3 digit, misal 001, 002, dst
        $orderNumberFormatted = str_pad($orderNumber, 3, '0', STR_PAD_LEFT);

        // Format kode order: OR-YYYYMMDD-XXX
        $kodeOrder = 'ORD-' . Carbon::now()->format('Ymd') . '-' . $orderNumberFormatted;

        return view('orders.create', compact('dataPelanggan', 'dataLayanan', 'currentlyDate', 'kodeOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->merge([
                'qty' => str_replace('.', '', $request->qty),
                'total' => str_replace('.', '', $request->total),
                'totalBayar' => str_replace('.', '', $request->totalBayar),
                'kembalian' => str_replace('.', '', $request->kembalian),
            ]);
            $validated = $request->validate([
                'kode_order' => 'required|string|max:50',
                'nama_pelanggan' => 'required|string|max:10',
                'jenis_layanan' => 'required|string|max:10',

                'berat' => 'nullable|decimal:0,2',
                'qty' => 'nullable|integer|min:0',

                'tanggal_masuk' => 'required|date',
                'tanggal_selesai' => 'required|date',

                'catatan' => 'nullable|string',

                'total' => 'required|numeric|min:0',
                'totalBayar' => 'required|numeric|min:0',
                'kembalian' => 'required|numeric|min:0',

                'metode' => 'required|string|max:10',
            ]);

            // $tanggalMasuk = Carbon::parse($validated['tanggal_masuk'])
            //     ->setTimeFrom(Carbon::now());

            // $tanggalSelesai = Carbon::parse($validated['tanggal_selesai'])
            //     ->setTimeFrom(Carbon::now());

            $id_user_login = Session::get('id_user');
            $now = now('Asia/Jakarta');

            $tanggalMasuk = Carbon::parse($validated['tanggal_masuk'])->setTimeFrom($now);
            $tanggalSelesai = Carbon::parse($validated['tanggal_selesai'])->setTimeFrom($now);

            // Cari ID terakhir
            $lastIdTransaksiOrders = Orders::orderBy('id_order', 'desc')->first();

            if ($lastIdTransaksiOrders) {
                $lastNumber = (int)substr($lastIdTransaksiOrders->id_order, 3); // Ambil angka dari 'SUP001'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'ORD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            Orders::create([
                'id_order' => $newId,
                'kode_order' => $validated['kode_order'],
                'id_pelanggan' => $validated['nama_pelanggan'],
                'id_layanan' => $validated['jenis_layanan'],
                'berat' => $validated['berat'],
                'jumlah' => $validated['qty'],
                'total' => $validated['total'],
                'status_order' => 'menunggu',
                'catatan' => $validated['catatan'],
                'tanggal_masuk' => $tanggalMasuk,
                'tanggal_selesai' => $tanggalSelesai,
            ]);

            // Cari ID terakhir
            $lastIdTransaksiPembayaran = Pembayaran::orderBy('id_pembayaran', 'desc')->first();

            if ($lastIdTransaksiPembayaran) {
                $lastNumberPay = (int)substr($lastIdTransaksiPembayaran->id_pembayaran, 3); // Ambil angka dari 'SUP001'
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

            // Cari ID terakhir
            $lastIdTransaksiLog = OrderStatusLog::orderBy('id_order_status_log', 'desc')->first();

            if ($lastIdTransaksiLog) {
                $lastNumberLog = (int)substr($lastIdTransaksiLog->id_order_status_log, 3); // Ambil angka dari 'SUP001'
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

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
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
            'tb_orders.id_layanan',

            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',

            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',

            'tb_orders.berat',
            'tb_orders.jumlah as qty',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.catatan',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',

            'tb_pembayaran.id_pembayaran',
            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
        ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->where('tb_orders.id_order', $id_order)
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

        return view('orders.edit', compact('dataOrder' ,'dataPelanggan', 'dataLayanan', 'currentlyDate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_order, string $id_pembayaran)
    {
        try{
            $request->merge([
                'qty' => str_replace('.', '', $request->qty),
                'total' => str_replace('.', '', $request->total),
                'totalBayar' => str_replace('.', '', $request->totalBayar),
                'kembalian' => str_replace('.', '', $request->kembalian),
            ]);
            $validated = $request->validate([
                'kode_order' => 'required|string|max:50',
                'nama_pelanggan' => 'required|string|max:10',
                'jenis_layanan' => 'required|string|max:10',

                'berat' => 'nullable|decimal:0,2',
                'qty' => 'nullable|integer|min:0',

                'tanggal_masuk' => 'required|date',
                'tanggal_selesai' => 'required|date',

                'catatan' => 'nullable|string',

                'total' => 'required|numeric|min:0',
                'totalBayar' => 'required|numeric|min:0',
                'kembalian' => 'required|numeric|min:0',

                'metode' => 'required|string|max:10',
            ]);

            // $tanggalMasuk = Carbon::parse($validated['tanggal_masuk'])
            //     ->setTimeFrom(Carbon::now());

            // $tanggalSelesai = Carbon::parse($validated['tanggal_selesai'])
            //     ->setTimeFrom(Carbon::now());

            $now = now('Asia/Jakarta');

            $tanggalMasuk = Carbon::parse($validated['tanggal_masuk'])->setTimeFrom($now);
            $tanggalSelesai = Carbon::parse($validated['tanggal_selesai'])->setTimeFrom($now);

            Orders::where('id_order', $id_order)->update([
                // 'kode_order' => $validated['kode_order'],
                // 'id_pelanggan' => $validated['nama_pelanggan'],
                'id_layanan' => $validated['jenis_layanan'],
                'berat' => $validated['berat'],
                'jumlah' => $validated['qty'],
                'total' => $validated['total'],
                // 'status_order' => 'menunggu',
                'catatan' => $validated['catatan'],
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

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    public function detail(string $id_order)
    {
        $dataOrder = Orders::select([
            'tb_orders.id_order',
            'tb_orders.kode_order',
            'tb_orders.id_pelanggan',
            'tb_orders.id_layanan',

            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.alamat',
            'tb_pelanggan.email',

            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',

            'tb_orders.berat',
            'tb_orders.jumlah as qty',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.catatan',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',

            'tb_pembayaran.id_pembayaran',
            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
        ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->where('tb_orders.id_order', $id_order)
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

        return view('orders.detail', compact('dataOrder' ,'dataPelanggan', 'dataLayanan', 'currentlyDate', 'dataOrderStatusLogs', 'role_login'));
    }

    public function cancel(Request $request, string $id_order)
    {
        Orders::where('id_order', $id_order)->update([
            'status_order' => 'dibatalkan',
        ]);

        $lastIdTransaksiLog = OrderStatusLog::orderBy('id_order_status_log', 'desc')->first();

        if ($lastIdTransaksiLog) {
            $lastNumberLog = (int)substr($lastIdTransaksiLog->id_order_status_log, 3); // Ambil angka dari 'SUP001'
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
            'id_user' => 'USR001',
            'tanggal_ubah' => $tanggalMasuk,
        ]);

        return redirect()->back();
    }

    public function change(Request $request, string $id_order)
    {
         $validated = $request->validate([
            'status_order' => 'required|string|max:50',
        ]);

        Orders::where('id_order', $id_order)->update([
            'status_order' => $validated['status_order'],
        ]);

        $lastIdTransaksiLog = OrderStatusLog::orderBy('id_order_status_log', 'desc')->first();

        if ($lastIdTransaksiLog) {
            $lastNumberLog = (int)substr($lastIdTransaksiLog->id_order_status_log, 3); // Ambil angka dari 'SUP001'
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
            'id_user' => 'USR001',
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
            'tb_orders.id_layanan',

            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.alamat',
            'tb_pelanggan.email',

            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',

            'tb_orders.berat',
            'tb_orders.jumlah as qty',
            'tb_orders.total',
            'tb_orders.status_order',
            'tb_orders.catatan',
            'tb_orders.tanggal_masuk',
            'tb_orders.tanggal_selesai',

            'tb_pembayaran.id_pembayaran',
            'tb_pembayaran.metode',
            'tb_pembayaran.jumlah',
            'tb_pembayaran.kembalian',
            'tb_pembayaran.bukti_transfer',
        ])
        ->join('tb_pembayaran', 'tb_pembayaran.id_order', '=', 'tb_orders.id_order')
        ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_orders.id_layanan')
        ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan', '=', 'tb_orders.id_pelanggan')
        ->where('tb_orders.id_order', $id_order)
        ->get();

        $dateNow = Carbon::now()->format('Y-m-d');
        $now = now('Asia/Jakarta');

        $currentlyDate = Carbon::parse($dateNow)->setTimeFrom($now);

        return view('orders.struk', compact('dataOrder' ,'currentlyDate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
