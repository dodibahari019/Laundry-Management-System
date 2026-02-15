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

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
            
            <!-- Welcome Header -->
            <div class="mb-12 fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">
                            Halo, <span class="gradient-text">{{ Auth::guard('pelanggan')->user()->first_name ?? Auth::guard('pelanggan')->user()->nama }}</span>
                        </h1>
                        <p class="text-gray-600 text-lg">Selamat datang kembali di dashboard Anda</p>
                    </div>
                    <div class="hidden md:block">
                        <img src="{{ asset('image/LogoDLaundry.png') }}" alt="D`Laundry" class="h-20 w-auto opacity-60">
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10 fade-in">
                <!-- Total Pesanan -->
                <div class="bg-white rounded-3xl p-6 border-2 border-gray-100 hover-scale">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Total Pesanan</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</h3>
                </div>

                <!-- Sedang Diproses -->
                <div class="bg-white rounded-3xl p-6 border-2 border-blue-100 hover-scale">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Sedang Diproses</p>
                    <h3 class="text-3xl font-bold text-blue-600">{{ $activeOrders }}</h3>
                </div>

                <!-- Siap Diambil -->
                <div class="bg-white rounded-3xl p-6 border-2 border-green-100 hover-scale">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Siap Diambil</p>
                    <h3 class="text-3xl font-bold text-green-600">{{ $readyOrders }}</h3>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-3xl p-6 border-2 border-gray-100 hover-scale">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm font-medium mb-1">Selesai</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $completedOrders }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Active Orders -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 fade-in">
                        <div class="p-8 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-900">Status Pesanan Aktif</h2>
                                </div>
                                <a href="{{ route('customer.orders') }}" class="text-purple-600 hover:text-purple-700 font-semibold text-sm flex items-center gap-2">
                                    Lihat Semua
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="p-8">
                            @if($activeOrdersList && count($activeOrdersList) > 0)
                                <div class="space-y-4">
                                    @foreach($activeOrdersList as $order)
                                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 border-2 border-gray-100 hover:border-purple-200 transition-all hover-scale">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Kode Order</p>
                                                <p class="text-lg font-bold text-gray-900">{{ $order->kode_order }}</p>
                                            </div>
                                            @php
                                                $statusConfig = [
                                                    'menunggu' => ['label' => 'Menunggu', 'color' => 'bg-yellow-100 text-yellow-700', 'icon' => ''],
                                                    'diproses' => ['label' => 'Diproses', 'color' => 'bg-blue-100 text-blue-700', 'icon' => ''],
                                                    'dicuci' => ['label' => 'Dicuci', 'color' => 'bg-orange-100 text-orange-700', 'icon' => ''],
                                                    'disetrika' => ['label' => 'Disetrika', 'color' => 'bg-purple-100 text-purple-700', 'icon' => ''],
                                                    'ready' => ['label' => 'Siap Diambil', 'color' => 'bg-green-100 text-green-700', 'icon' => ''],
                                                ];
                                                $status = $statusConfig[$order->status_order] ?? ['label' => $order->status_order, 'color' => 'bg-gray-100 text-gray-700', 'icon' => ''];
                                            @endphp
                                            <span class="status-badge {{ $status['color'] }}">
                                                {{ $status['icon'] }} {{ $status['label'] }}
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">Layanan</p>
                                                <p class="text-sm font-semibold text-gray-900">{{ $order->nama_layanan }}
                                                    @if($order->total_items > 1)
                                                        <span class="text-xs text-gray-500">+{{ $order->total_items - 1 }} lainnya</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">Total</p>
                                                <p class="text-sm font-semibold text-purple-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                            </div>
                                        </div>

                                        <div class="bg-white rounded-xl p-4 mb-4">
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-600">Estimasi Selesai</span>
                                                <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($order->tanggal_selesai)->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>

                                        <div class="flex gap-3">
                                            <a href="{{ url('customer-orders-detail', $order->id_order) }}" class="flex-1 text-center px-4 py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 transition">
                                                Lihat Detail
                                            </a>
                                            <a href="{{ url('/tracking?nota=' . $order->kode_order) }}" class="px-4 py-3 border-2 border-purple-600 text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition">
                                                Lacak
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-16">
                                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg mb-6">Belum ada pesanan aktif saat ini</p>
                                    <a href="{{ url('/order') }}" class="inline-flex items-center gap-2 gradient-primary text-white px-8 py-4 rounded-2xl font-bold hover:opacity-90 transition shadow-xl">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Buat Pesanan Baru
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Quick Actions -->
                <div class="space-y-6">
                    <!-- Quick Actions Card -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h3>
                        
                        <div class="space-y-3">
                            <a href="{{ url('/customer-orders') }}" class="flex items-center gap-4 p-4 bg-white-50 border border-blue-200 rounded-2xl hover:shadow-lg transition-all hover-scale group">
                                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">Pesan Lagi</p>
                                    <p class="text-xs text-gray-600">Buat pesanan baru</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>

                            <a href="{{ url('/tracking') }}" class="flex items-center gap-4 p-4 bg-white-50 border border-emerald-200 rounded-2xl hover:shadow-lg transition-all hover-scale group">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">Lacak Pesanan</p>
                                    <p class="text-xs text-gray-600">Cek status cucian</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- <!-- Promo Banner -->
                    <div class="gradient-primary rounded-3xl p-8 text-white shadow-xl fade-in relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
                        
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Promo Spesial!</h3>
                            <p class="text-sm text-purple-100 mb-4">Dapatkan diskon 20% untuk pesanan pertama kamu di bulan ini</p>
                            <button class="bg-white text-purple-600 px-6 py-2 rounded-xl font-bold text-sm hover:bg-purple-50 transition">
                                Klaim Sekarang
                            </button>
                        </div>
                    </div> --}}

                    {{-- <!-- Tips Card -->
                    <div class="bg-blue-50 border-2 border-blue-200 rounded-3xl p-6 fade-in">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-900 mb-2">Tips Laundry</h4>
                                <p class="text-sm text-blue-800 leading-relaxed">
                                    Pisahkan pakaian berwarna gelap dan terang sebelum menyerahkan ke kami untuk hasil terbaik!
                                </p>
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </section>

    @include('landingPageComponent.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>