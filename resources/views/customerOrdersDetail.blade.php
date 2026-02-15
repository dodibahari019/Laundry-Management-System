<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D`Laundry</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('image/LogoDLaundry.png') }}"  type="image/png">
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

        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 3px solid;
        }

        .timeline-line {
            width: 2px;
            min-height: 40px;
        }
    </style>
</head>
<body class="bg-gray-50">

    @include('landingPageComponent.navbar')

    <!-- Main Content -->
    <section class="pt-32 pb-24 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column - Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Order Header Card -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden fade-in">
                        <div class="gradient-primary p-8 text-white">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-purple-100 text-sm mb-1">Kode Pesanan</p>
                                    <h2 class="text-3xl font-bold">{{ $order->kode_order }}</h2>
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
                                <span class="status-badge {{ $status['color'] }}">
                                    {{ $status['icon'] }} {{ $status['label'] }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                                    <p class="text-purple-100 text-xs mb-1">Tanggal Masuk</p>
                                    <p class="text-white font-bold">{{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                                    <p class="text-purple-100 text-xs mb-1">Estimasi Selesai</p>
                                    <p class="text-white font-bold">{{ \Carbon\Carbon::parse($order->tanggal_selesai)->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Informasi Pelanggan</h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                                <p class="text-gray-900 font-semibold">{{ $order->pelanggan->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">No. Telepon</p>
                                <p class="text-gray-900 font-semibold">{{ $order->pelanggan->no_hp }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Email</p>
                                <p class="text-gray-900 font-semibold">{{ $order->pelanggan->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Kategori Alamat</p>
                                <p class="text-gray-900 font-semibold capitalize">{{ $order->kategori_alamat }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Alamat Pickup</p>
                                <p class="text-gray-900 font-semibold">{{ $order->alamat_pickup }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pickup Information -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Informasi Penjemputan</h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tanggal Pickup</p>
                                <p class="text-gray-900 font-semibold">{{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Waktu Pickup</p>
                                <p class="text-gray-900 font-semibold">{{ $order->pickup_time }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tipe Pickup</p>
                                <p class="text-gray-900 font-semibold capitalize">{{ $order->pickup_type }}</p>
                            </div>
                            @if($order->instruksi_driver)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Instruksi untuk Driver</p>
                                <p class="text-gray-900 font-semibold">{{ $order->instruksi_driver }}</p>
                            </div>
                            @endif
                            @if($order->instruksi_alamat)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Instruksi Alamat</p>
                                <p class="text-gray-900 font-semibold">{{ $order->instruksi_alamat }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Detail Layanan</h3>
                        </div>

                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                            <div class="border-2 border-gray-100 rounded-2xl p-5 hover:border-purple-200 transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ $item->layanan->nama_layanan }}</h4>
                                        <div class="flex items-center gap-4 text-sm text-gray-600">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                                </svg>
                                                {{ $item->qty }} {{ $item->layanan->jenis === 'kiloan' ? 'kg' : 'pcs' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-500 mb-1">Subtotal</p>
                                        <p class="text-xl font-bold text-purple-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Total -->
                        <div class="mt-6 pt-6 border-t-2 border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-600 mb-1">Total Pembayaran</p>
                                    <p class="text-sm text-gray-500">{{ $order->orderItems->sum('qty') }} item</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold gradient-text">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column - Payment & Actions -->
                <div class="space-y-6">
                    
                    <!-- Payment Status -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Pembayaran</h3>
                        </div>

                        @if($order->pembayaran)
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Status Pembayaran</p>
                                @php
                                    $paymentStatus = $order->pembayaran->status;
                                    $paymentConfig = [
                                        'pending' => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-yellow-100 text-yellow-700', 'icon' => ''],
                                        'settlement' => ['label' => 'Lunas', 'color' => 'bg-green-100 text-green-700', 'icon' => ''],
                                        'failed' => ['label' => 'Gagal', 'color' => 'bg-red-100 text-red-700', 'icon' => ''],
                                        'expire' => ['label' => 'Kadaluarsa', 'color' => 'bg-gray-100 text-gray-700', 'icon' => ''],
                                    ];
                                    $payment = $paymentConfig[$paymentStatus] ?? ['label' => $paymentStatus, 'color' => 'bg-gray-100 text-gray-700', 'icon' => ''];
                                @endphp
                                <span class="status-badge {{ $payment['color'] }}">
                                    {{ $payment['icon'] }} {{ $payment['label'] }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 mb-1">Metode Pembayaran</p>
                                <p class="text-gray-900 font-semibold capitalize">{{ $order->pembayaran->payment_channel ?? $order->pembayaran->metode }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 mb-1">Jumlah</p>
                                <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($order->pembayaran->jumlah, 0, ',', '.') }}</p>
                            </div>

                            @if($order->pembayaran->paid_at)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Dibayar Pada</p>
                                <p class="text-gray-900 font-semibold">{{ \Carbon\Carbon::parse($order->pembayaran->paid_at)->format('d M Y, H:i') }}</p>
                            </div>
                            @endif

                            @if($order->pembayaran->status === 'pending' && $order->pembayaran->payment_reference)
                            <button id="pay-button" class="w-full gradient-primary text-white px-6 py-4 rounded-2xl font-bold hover:opacity-90 transition shadow-xl">
                                Bayar Sekarang
                            </button>
                            @endif
                        </div>
                        @else
                        <p class="text-gray-500 text-center py-4">Informasi pembayaran tidak tersedia</p>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Aksi Cepat</h3>
                        
                        <div class="space-y-3">
                            <a href="{{ url('/tracking?nota=' . $order->kode_order) }}" class="flex items-center gap-4 p-4 bg-white border border-blue-200 rounded-2xl hover:shadow-lg transition-all hover-scale group">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">Lacak Pesanan</p>
                                    <p class="text-xs text-gray-600">Lihat status real-time</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>

                            <a href="{{ route('customer.orders') }}" class="flex items-center gap-4 p-4 bg-white border border-purple-200 rounded-2xl hover:shadow-lg transition-all hover-scale group">
                                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">Semua Pesanan</p>
                                    <p class="text-xs text-gray-600">Lihat riwayat lengkap</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>

                            <a href="{{ url('customer-dashboard') }}" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-2xl hover:shadow-lg transition-all hover-scale group">
                                <div class="w-12 h-12 bg-gradient-to-br from-gray-400 to-gray-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900">Dashboard</p>
                                    <p class="text-xs text-gray-600">Kembali ke beranda</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Location Map (if available) -->
                    @if($order->orderLocations)
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Lokasi Pickup</h3>
                        </div>

                        <div class="rounded-2xl overflow-hidden border-2 border-gray-200 mb-4">
                            <div id="map" style="height: 200px; width: 100%;">
                                <iframe 
                                    width="100%" 
                                    height="200" 
                                    frameborder="0" 
                                    scrolling="no" 
                                    marginheight="0" 
                                    marginwidth="0" 
                                    src="https://maps.google.com/maps?q={{ $order->orderLocations->latitude }},{{ $order->orderLocations->longitude }}&hl=id&z=15&output=embed"
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>

                        <a href="https://www.google.com/maps?q={{ $order->orderLocations->latitude }},{{ $order->orderLocations->longitude }}" target="_blank" class="flex items-center justify-center gap-2 text-gray-600 hover:text-gray-700 font-semibold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div>
                    @endif

                </div>

            </div>
        </div>
    </section>

    @include('landingPageComponent.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if($order->pembayaran && $order->pembayaran->status === 'pending' && $order->pembayaran->payment_reference)
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $order->pembayaran->payment_reference }}', {
                onSuccess: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil!',
                        text: 'Terima kasih atas pembayaran Anda',
                        confirmButtonColor: '#667eea',
                    }).then(() => {
                        window.location.reload();
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Pending',
                        text: 'Silakan selesaikan pembayaran Anda',
                        confirmButtonColor: '#667eea',
                    });
                },
                onError: function(result) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pembayaran Gagal',
                        text: 'Terjadi kesalahan saat memproses pembayaran',
                        confirmButtonColor: '#667eea',
                    });
                },
                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        });
    </script>
    @endif
</body>
</html>