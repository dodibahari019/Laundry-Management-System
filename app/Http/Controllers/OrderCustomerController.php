<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\OrderLocations;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Models\OrderStatusLog;
use App\Services\MidtransService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderCustomerController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Display order form
     */
    public function index()
    {
        $dataLayanan = Layanan::where('status', 'Aktif')->get();
        $currentlyDate = Carbon::now()->format('Y-m-d');

        // Get customer data if logged in
        $customer = Auth::guard('pelanggan')->user();

        $firstName = $customer->first_name ?? '';
        $lastName = $customer->last_name ?? '';
        $email = $customer->email ?? '';
        $noHp = $customer->no_hp ?? '';
        $gender = $customer->gender ?? null;

        return view('pemesananPage', compact(
            'dataLayanan',
            'currentlyDate',
            'firstName',
            'lastName',
            'email',
            'noHp',
            'gender'
        ));
    }

    /**
     * Dashboard Customer - Display real user data
     */
    public function dashboardCustomer()
    {
        // Check if user is logged in
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->back();
        }

        $customer = Auth::guard('pelanggan')->user();
        $customerId = $customer->id_pelanggan;

        // Get all orders for this customer
        $allOrders = Orders::where('id_pelanggan', $customerId)->get();

        // Total orders count
        $totalOrders = $allOrders->count();

        // Active orders (menunggu, diproses, dicuci, disetrika)
        $activeOrders = $allOrders->whereIn('status_order', ['menunggu', 'diproses', 'dicuci', 'disetrika'])->count();

        // Ready orders (ready for pickup)
        $readyOrders = $allOrders->where('status_order', 'ready')->count();

        // Completed orders (diambil)
        $completedOrders = $allOrders->where('status_order', 'diambil')->count();

        // Get active orders list with details (latest 5)
        $activeOrdersList = Orders::with(['orderItems.layanan', 'pembayaran'])
            ->where('id_pelanggan', $customerId)
            ->whereIn('status_order', ['menunggu', 'diproses', 'dicuci', 'disetrika', 'ready'])
            ->orderBy('tanggal_masuk', 'desc')
            ->limit(5)
            ->get()
            ->map(function($order) {
                // Get first service name from order items
                $firstService = $order->orderItems->first();
                $order->nama_layanan = $firstService ? $firstService->layanan->nama_layanan : 'N/A';
                
                // Count total items
                $order->total_items = $order->orderItems->sum('qty');
                
                return $order;
            });

        // Get top 5 most popular services (for recommendations)
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

        return view('customerDashboard', compact(
            'totalOrders',
            'activeOrders',
            'readyOrders',
            'completedOrders',
            'activeOrdersList',
            'top4Layanan'
        ));
    }

    /**
     * Store order
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'kategori_alamat' => 'required|in:rumah,kost,kantor,hotel',
            'alamat_lengkap' => 'required|string',
            'instruksi_alamat' => 'nullable|string',
            'jenis_kontak' => 'required|in:individu,perusahaan',
            'nama_perusahaan' => 'required_if:jenis_kontak,perusahaan',
            'nama_depan' => 'required|string',
            'nama_belakang' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'nomor_telepon' => 'required|string',
            'email' => 'required|email',
            'picked_up_date' => 'required|date',
            'picked_up_time' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'pickup_type' => 'required|in:langsung,satpam,tetangga,lainnya',
            'instruksi_driver' => 'nullable|string',
            'services' => 'required|array|min:1',
            'services.*.id_layanan' => 'required|exists:tb_layanan,id_layanan',
            'services.*.quantity' => 'required|integer|min:1',
            'create_account' => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            // 1. Get or Create Customer
            $customerData = $this->getOrCreateCustomer($request);
            $customer = $customerData['customer'];
            $isNewAccount = $customerData['is_new_account'];
            $tempPassword = $customerData['temp_password'] ?? null;

            // 2. Generate Order ID
            $lastIdTransaksiOrders = Orders::orderBy('id_order', 'desc')->first();

            if ($lastIdTransaksiOrders) {
                $lastNumber = (int)substr($lastIdTransaksiOrders->id_order, 3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'ORD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            $kodeOrder = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            // 3. Calculate Total & Prepare Items
            $total = 0;
            $items = [];

            foreach ($request->services as $service) {
                $layanan = Layanan::findOrFail($service['id_layanan']);
                $qty = $service['quantity'];
                $subtotal = $layanan->harga * $qty;
                $total += $subtotal;

                $items[] = [
                    'id_layanan' => $layanan->id_layanan,
                    'qty' => $qty,
                    'harga' => $layanan->harga,
                    'subtotal' => $subtotal,
                    'nama_layanan' => $layanan->nama_layanan
                ];
            }

            // 4. Parse pickup time
            $pickupTimeRange = $request->picked_up_time;

            if (strpos($pickupTimeRange, '-') !== false) {
                $timeArray = explode('-', $pickupTimeRange);
                $pickupTime = trim($timeArray[0]) . ':00';
            } else {
                $pickupTime = $pickupTimeRange . ':00';
            }

            // 5. Create Order
            $order = Orders::create([
                'id_order' => $newId,
                'kode_order' => $kodeOrder,
                'id_pelanggan' => $customer->id_pelanggan,
                'total' => $total,
                'status_order' => 'menunggu',
                'pickup_date' => $request->picked_up_date,
                'pickup_time' => $pickupTime,
                'pickup_type' => $request->pickup_type,
                'alamat_pickup' => $request->alamat_lengkap,
                'kategori_alamat' => $request->kategori_alamat,
                'instruksi_alamat' => $request->instruksi_alamat,
                'instruksi_driver' => $request->instruksi_driver,
                'tanggal_masuk' => Carbon::now(),
                'tanggal_selesai' => Carbon::now()->addDays(3),
            ]);

            // 6. Create Order Items
            $lastItem = OrderItems::orderBy('id_order_item', 'desc')->first();
            $lastNumber = $lastItem ? (int) substr($lastItem->id_order_item, 3) : 0;

            foreach ($items as $item) {
                $lastNumber++;
                $newIdOrderItems = 'ORI' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

                OrderItems::create([
                    'id_order_item' => $newIdOrderItems,
                    'id_order' => $newId,
                    'id_layanan' => $item['id_layanan'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            // 7. Create Order Location
            $lastIdTransaksiOrderLocations = OrderLocations::orderBy('id_order_locations', 'desc')->first();

            if ($lastIdTransaksiOrderLocations) {
                $lastNumber = (int)substr($lastIdTransaksiOrderLocations->id_order_locations, 3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newIdOrderLocations = 'ORL' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            OrderLocations::create([
                'id_order_locations' => $newIdOrderLocations,
                'id_order' => $newId,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'formatted_address' => $request->alamat_lengkap,
            ]);

            // 8. Create Payment Record
            $lastIdTransaksiPembayaran = Pembayaran::orderBy('id_pembayaran', 'desc')->first();

            if ($lastIdTransaksiPembayaran) {
                $lastNumberPay = (int)substr($lastIdTransaksiPembayaran->id_pembayaran, 3);
                $newNumberPay = $lastNumberPay + 1;
            } else {
                $newNumberPay = 1;
            }

            $newIdPay = 'PAY' . str_pad($newNumberPay, 3, '0', STR_PAD_LEFT);

            $pembayaran = Pembayaran::create([
                'id_pembayaran' => $newIdPay,
                'id_order' => $newId,
                'metode' => 'transfer',
                'gateway' => 'midtrans',
                'jumlah' => $total,
                'status' => 'settlement',
                'tanggal_bayar' => Carbon::now(),
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
                'id_order' => $newId,
                'status' => 'menunggu',
                'id_user' => 'USR001',
                'tanggal_ubah' => $tanggalMasuk,
            ]);

            // 9. Reload order dengan relationship
            $order = Orders::with(['orderItems.layanan', 'pelanggan', 'orderLocations'])
                ->findOrFail($newId);

            Log::info('Order loaded with items count: ' . $order->orderItems->count());

            // 10. Create Midtrans Transaction
            $customerDetails = [
                'first_name' => $request->nama_depan,
                'last_name' => $request->nama_belakang,
                'email' => $request->email,
                'phone' => '+62' . $request->nomor_telepon,
                'billing_address' => [
                    'address' => $request->alamat_lengkap,
                ],
            ];

            $midtransResult = $this->midtransService->createTransaction($order, $customerDetails);

            if (!$midtransResult['success']) {
                throw new \Exception('Gagal membuat transaksi Midtrans: ' . $midtransResult['message']);
            }

            // 11. Update payment with snap token
            $pembayaran->update([
                'payment_reference' => $midtransResult['snap_token'],
                'expired_at' => Carbon::now()->addDay(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'data' => [
                    'order_id' => $newId,
                    'kode_order' => $kodeOrder,
                    'snap_token' => $midtransResult['snap_token'],
                    'total' => $total,
                    'auto_login' => $isNewAccount && $request->create_account,
                    'customer_email' => $customer->email,
                    'temp_password' => $tempPassword,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Order Creation Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            Log::error('Request Data: ' . json_encode($request->all()));

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get or create customer
     */
    private function getOrCreateCustomer(Request $request)
    {
        // Check if customer is logged in
        if (Auth::guard('pelanggan')->check()) {
            return [
                'customer' => Auth::guard('pelanggan')->user(),
                'is_new_account' => false,
                'temp_password' => null
            ];
        }

        // Check if customer exists by email
        $customer = Pelanggan::where('email', $request->email)->first();

        if ($customer) {
            return [
                'customer' => $customer,
                'is_new_account' => false,
                'temp_password' => null
            ];
        }

        // Generate Customer ID
        $lastCustomer = Pelanggan::orderBy('id_pelanggan', 'desc')->first();

        if ($lastCustomer) {
            $lastNumber = (int)substr($lastCustomer->id_pelanggan, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newCustomerId = 'PLG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Generate temporary password
        $tempPassword = Str::random(8);

        // Tentukan status berdasarkan create_account
        $status = $request->create_account ? 'active' : 'inactive';

        // Create new customer
        $customer = Pelanggan::create([
            'id_pelanggan' => $newCustomerId,
            'nama' => $request->nama_depan . ' ' . $request->nama_belakang,
            'first_name' => $request->nama_depan,
            'last_name' => $request->nama_belakang,
            'gender' => $request->jenis_kelamin,
            'jenis_kontak' => $request->jenis_kontak,
            'company_name' => $request->nama_perusahaan ?? null,
            'kategori_alamat' => $request->kategori_alamat,
            'default_address' => $request->alamat_lengkap,
            'no_hp' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'status' => $status,
            'alamat' => $request->alamat_lengkap,
            'email_verified_at' => $request->create_account ? now() : null,
        ]);

        return [
            'customer' => $customer,
            'is_new_account' => $request->create_account ? true : false,
            'temp_password' => $request->create_account ? $tempPassword : null
        ];
    }

    /**
     * Auto login customer (dipanggil dari frontend)
     */
    public function autoLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => '/customer/dashboard'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login gagal'
        ], 401);
    }

    /**
     * Show order detail
     */
    public function detail($id_order)
    {
        // Check if user is logged in
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('customer.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $customer = Auth::guard('pelanggan')->user();

        $order = Orders::with(['pelanggan', 'orderItems.layanan', 'pembayaran', 'orderLocations'])
            ->where('id_order', $id_order)
            ->where('id_pelanggan', $customer->id_pelanggan) // Ensure user can only see their own orders
            ->firstOrFail();

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

        return view('customerOrdersDetail', compact('order', 'top4Layanan'));
    }

    /**
     * Show all orders for customer
     */
    public function orders()
    {
        // Check if user is logged in
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('customer.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $customer = Auth::guard('pelanggan')->user();

        $orders = Orders::with(['orderItems.layanan', 'pembayaran'])
            ->where('id_pelanggan', $customer->id_pelanggan)
            ->orderBy('tanggal_masuk', 'desc')
            ->paginate(10);

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

        return view('customerOrders', compact('orders', 'top4Layanan'));
    }

    /**
     * Handle Midtrans callback
     */
    public function handleCallback(Request $request)
    {
        try {
            $serverKey = config('midtrans.server_key');
            $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashed !== $request->signature_key) {
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            $kodeOrder = $request->order_id;
            $order = Orders::where('kode_order', $kodeOrder)->firstOrFail();
            $pembayaran = $order->pembayaran;

            // Update payment status
            $status = $request->transaction_status;
            $fraud = $request->fraud_status ?? 'accept';

            if ($status == 'capture') {
                $pembayaran->status = $fraud == 'accept' ? 'settlement' : 'pending';
            } else if ($status == 'settlement') {
                $pembayaran->status = 'settlement';
                $pembayaran->paid_at = Carbon::now();
                $order->status_order = 'diproses';
            } else if ($status == 'pending') {
                $pembayaran->status = 'pending';
            } else if ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
                $pembayaran->status = 'failed';
                $order->status_order = 'dibatalkan';
            }

            $pembayaran->gateway_transaction_id = $request->transaction_id;
            $pembayaran->payment_channel = $request->payment_type;
            $pembayaran->raw_response = json_encode($request->all());
            $pembayaran->save();
            $order->save();

            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}