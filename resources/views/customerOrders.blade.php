<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D`Laundry</title>
    <!-- Favicon -->
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body class="bg-gray-50">

    @include('landingPageComponent.navbar')

    <!-- Main Content -->
    <section class="pt-32 pb-24 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="mb-12 fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            <span class="gradient-text">Pesanan Saya</span>
                        </h1>
                        <p class="text-gray-600 text-lg">Kelola dan lacak semua pesanan laundry Anda</p>
                    </div>
                    <a href="{{ url('/customer-orders') }}" class="hidden md:inline-flex items-center gap-2 gradient-primary text-white px-6 py-3 rounded-2xl font-bold hover:opacity-90 transition shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Pesanan Baru
                    </a>
                </div>
            </div>

            <!-- Orders List -->
            @if($orders && count($orders) > 0)
                <div class="space-y-4 fade-in">
                    @foreach($orders as $order)
                    <div class="bg-white rounded-3xl p-6 border-2 border-gray-100 hover:border-purple-200 transition-all hover-scale">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Kode Order</p>
                                <p class="text-xl font-bold text-gray-900">{{ $order->kode_order }}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d M Y, H:i') }}
                                </p>
                            </div>
                            
                            @php
                                $statusConfig = [
                                    'menunggu' => ['label' => 'Menunggu', 'color' => 'bg-yellow-100 text-yellow-700', 'icon' => ''],
                                    'diproses' => ['label' => 'Diproses', 'color' => 'bg-blue-100 text-blue-700', 'icon' => ''],
                                    'dicuci' => ['label' => 'Dicuci', 'color' => 'bg-orange-100 text-orange-700', 'icon' => ''],
                                    'disetrika' => ['label' => 'Disetrika', 'color' => 'bg-purple-100 text-purple-700', 'icon' => ''],
                                    'ready' => ['label' => 'Siap Diambil', 'color' => 'bg-green-100 text-green-700', 'icon' => ''],
                                    'diambil' => ['label' => 'Selesai', 'color' => 'bg-gray-100 text-gray-700', 'icon' => ''],
                                    'dibatalkan' => ['label' => 'Dibatalkan', 'color' => 'bg-red-100 text-red-700', 'icon' => ''],
                                ];
                                $status = $statusConfig[$order->status_order] ?? ['label' => $order->status_order, 'color' => 'bg-gray-100 text-gray-700', 'icon' => ''];
                            @endphp
                            
                            <span class="status-badge {{ $status['color'] }} w-fit">
                                {{ $status['icon'] }} {{ $status['label'] }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 mb-1">Total Item</p>
                                <p class="text-lg font-bold text-gray-900">{{ $order->orderItems->sum('qty') }} item</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 mb-1">Total Pembayaran</p>
                                <p class="text-lg font-bold text-purple-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 mb-1">Status Pembayaran</p>
                                @if($order->pembayaran)
                                    @php
                                        $paymentStatus = $order->pembayaran->status;
                                        $paymentConfig = [
                                            'pending' => ['label' => 'Pending', 'color' => 'text-yellow-600'],
                                            'settlement' => ['label' => 'Lunas', 'color' => 'text-green-600'],
                                            'failed' => ['label' => 'Gagal', 'color' => 'text-red-600'],
                                        ];
                                        $payment = $paymentConfig[$paymentStatus] ?? ['label' => $paymentStatus, 'color' => 'text-gray-600'];
                                    @endphp
                                    <p class="text-lg font-bold {{ $payment['color'] }}">{{ $payment['label'] }}</p>
                                @else
                                    <p class="text-lg font-bold text-gray-600">-</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('customer.orders.detail', $order->id_order) }}" class="flex-1 text-center px-4 py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 transition">
                                Lihat Detail
                            </a>
                            <a href="{{ url('/tracking?nota=' . $order->kode_order) }}" class="flex-1 text-center px-4 py-3 border-2 border-purple-600 text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition">
                                Lacak Pesanan
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 fade-in">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="bg-white rounded-3xl p-16 text-center fade-in">
                    <svg class="w-32 h-32 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Pesanan</h3>
                    <p class="text-gray-600 mb-8">Anda belum memiliki pesanan apapun. Mulai pesan sekarang!</p>
                    <a href="{{ url('/order') }}" class="inline-flex items-center gap-2 gradient-primary text-white px-8 py-4 rounded-2xl font-bold hover:opacity-90 transition shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Pesanan Baru
                    </a>
                </div>
            @endif

        </div>
    </section>

    @include('landingPageComponent.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>