<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan - D`Laundry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('image/LogoDLaundry.png') }}" type="image/png">
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
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .status-badge {
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body class="bg-gray-50">

    @include('landingPageComponent.navbar')

    <!-- Tracking Section -->
    <section id="tracking" class="pt-32 pb-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Lacak Cucian Anda</h2>
                <p class="text-xl text-gray-600">Masukkan kode order untuk melihat status real-time</p>
            </div>

            <div class="bg-white rounded-3xl p-12 shadow-2xl border border-gray-100 fade-in">
                <form id="trackingForm" class="space-y-6">
                    @csrf
                    <div>
                        <label for="nota" class="block text-sm font-bold text-gray-700 mb-3">Kode Order</label>
                        <input
                            type="text"
                            id="nota"
                            name="nota"
                            value="{{ $kodeOrder ?? '' }}"
                            placeholder="Contoh: INV-20241205-ABC123"
                            class="w-full px-6 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-lg"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full gradient-primary text-white px-8 py-5 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-xl flex items-center justify-center"
                    >
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cek Status Cucian
                    </button>
                </form>

                @if($kodeOrder && !$order)
                <div class="mt-6 p-4 bg-red-50 border-2 border-red-200 rounded-2xl fade-in">
                    <p class="text-red-700 text-center font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        Pesanan tidak ditemukan! Periksa kembali kode pesanan Anda.
                    </p>
                </div>
                @endif

                <div class="mt-8 p-6 bg-purple-50 rounded-2xl border-2 border-purple-100">
                    <div class="flex items-start gap-4">
                        <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-bold text-gray-900 mb-1">Tips Penting</p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Nomor kode order tercantum pada struk yang Anda terima saat menyerahkan cucian atau di email konfirmasi pesanan.
                                Simpan struk dengan baik untuk memudahkan tracking dan pengambilan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Result Modal -->
            @if($order)
            <div id="trackingResult" class="mt-8 bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Status Cucian Anda</h3>
                        <p class="text-sm text-gray-500 mt-1">Informasi real-time pesanan laundry</p>
                    </div>
                    <a href="{{ url('/tracking') }}" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>

                <div class="p-8 space-y-6">
                    <!-- Order Info Header -->
                    <div class="bg-white-100 p-6 rounded-2xl border border-purple-200">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Kode Order</p>
                                <p class="text-3xl font-bold text-gray-600">{{ $order->kode_order }}</p>
                            </div>
                            <div class="text-right">
                                @php
                                    $statusConfig = [
                                        'menunggu' => ['label' => 'Menunggu Diproses', 'color' => 'bg-yellow-100 text-yellow-700'],
                                        'diproses' => ['label' => 'Sedang Diproses', 'color' => 'bg-blue-100 text-blue-700'],
                                        'dicuci' => ['label' => 'Sedang Dicuci', 'color' => 'bg-orange-100 text-orange-700'],
                                        'disetrika' => ['label' => 'Sedang Disetrika', 'color' => 'bg-purple-100 text-purple-700'],
                                        'ready' => ['label' => 'Siap Diambil', 'color' => 'bg-green-100 text-green-700'],
                                        'diambil' => ['label' => 'Selesai & Diambil', 'color' => 'bg-gray-100 text-gray-700'],
                                        'dibatalkan' => ['label' => 'Order Dibatalkan', 'color' => 'bg-red-100 text-red-700'],
                                    ];
                                    $currentStatus = $statusConfig[$order->status_order] ?? ['label' => $order->status_order, 'color' => 'bg-gray-100 text-gray-700'];
                                @endphp
                                <span class="status-badge {{ $currentStatus['color'] }}">{{ $currentStatus['label'] }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div class="bg-white p-4 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Masuk</p>
                                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500">Estimasi Selesai</p>
                                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($order->tanggal_selesai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer & Service Info -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <h4 class="text-lg font-bold text-gray-900">Nama Pelanggan</h4>
                            </div>
                            <p class="text-md font-small text-gray-900">{{ $order->pelanggan->nama }}</p>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <h4 class="text-lg font-bold text-gray-900">Layanan</h4>
                            </div>
                            <div class="flex items-center space-x-3">
                                @php
                                    $firstItem = $order->orderItems->first();
                                    $totalItems = $order->orderItems->count();
                                @endphp
                                <p class="text-md font-small text-gray-900">
                                    {{ $firstItem ? $firstItem->layanan->nama_layanan : 'N/A' }}
                                    @if($totalItems > 1)
                                        <span class="text-xs text-gray-500">+{{ $totalItems - 1 }} lainnya</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Timeline -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <h4 class="text-lg font-bold text-gray-900">Riwayat Status</h4>
                        </div>

                        <div class="space-y-4">
                            @php
                                // Define all possible statuses in order
                                $allStatuses = [
                                    ['status' => 'menunggu', 'label' => 'Menunggu Diproses', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ['status' => 'diproses', 'label' => 'Sedang Diproses', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                                    ['status' => 'dicuci', 'label' => 'Sedang Dicuci', 'icon' => 'M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm7 14a5 5 0 110-10 5 5 0 010 10z'],
                                    ['status' => 'disetrika', 'label' => 'Sedang Disetrika', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                    ['status' => 'ready', 'label' => 'Siap Diambil', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ['status' => 'diambil', 'label' => 'Selesai & Diambil', 'icon' => 'M5 13l4 4L19 7'],
                                ];

                                $statusOrder = ['menunggu', 'diproses', 'dicuci', 'disetrika', 'ready', 'diambil'];
                                $currentIndex = array_search($order->status_order, $statusOrder);
                                
                                $configs = [
                                    'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'border' => 'border-yellow-200'],
                                    'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'border' => 'border-blue-200'],
                                    'dicuci' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-600', 'border' => 'border-orange-200'],
                                    'disetrika' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'border' => 'border-purple-200'],
                                    'ready' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'border' => 'border-green-200'],
                                    'diambil' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'border' => 'border-gray-200'],
                                ];
                            @endphp

                            @foreach($allStatuses as $index => $statusItem)
                                @php
                                    $isCompleted = $index < $currentIndex;
                                    $isActive = $index == $currentIndex;
                                    $isFuture = $index > $currentIndex;
                                    $config = $configs[$statusItem['status']] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'border' => 'border-gray-200'];
                                    
                                    // Find matching log from statusHistory
                                    $log = null;
                                    if ($statusHistory) {
                                        $log = $statusHistory->firstWhere('status', $statusItem['status']);
                                    }
                                @endphp

                                <div class="flex items-start space-x-4">
                                    <div class="flex flex-col items-center">
                                        <div class="w-10 h-10 {{ $isCompleted || $isActive ? $config['bg'] : 'bg-gray-100' }} rounded-full flex items-center justify-center border-2 {{ $isCompleted || $isActive ? $config['border'] : 'border-gray-200' }}">
                                            <svg class="w-5 h-5 {{ $isCompleted || $isActive ? $config['text'] : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusItem['icon'] }}"></path>
                                            </svg>
                                        </div>
                                        @if(!$loop->last)
                                        <div class="w-0.5 h-16 {{ $isCompleted ? 'bg-purple-300' : 'bg-gray-300' }}"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 {{ !$loop->last ? 'pb-4' : '' }}">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <p class="font-bold text-gray-900 text-base">{{ $statusItem['label'] }}</p>
                                                @if($log)
                                                    <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($log->tanggal_ubah)->format('d M Y, H:i') }} WIB</p>
                                                @elseif($isFuture)
                                                    <p class="text-sm text-gray-400 mt-1 italic">Belum diproses</p>
                                                @endif
                                            </div>
                                            @if($isActive)
                                                <span class="px-3 py-1 {{ $config['bg'] }} {{ $config['text'] }} rounded-full text-xs font-bold uppercase">Saat Ini</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Catatan (if exists) -->
                    @if($order->catatan)
                    <div class="border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">Catatan Khusus</h4>
                                <p class="text-gray-700">{{ $order->catatan }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <a href="{{ url('/tracking') }}" class="flex-1 text-center px-6 py-4 bg-white border-2 border-purple-600 text-purple-600 rounded-2xl font-bold hover:bg-purple-50 transition">
                            Lacak Pesanan Lain
                        </a>
                        
                        <a href="{{ url('/') }}" class="flex-1 text-center px-6 py-4 gradient-primary text-white rounded-2xl font-bold hover:opacity-90 transition shadow-xl">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    @include('landingPageComponent.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Auto format input kode order
        document.getElementById("nota").addEventListener("input", function () {
            let val = this.value.replace(/-/g, "").toUpperCase();
            
            let prefix = val.slice(0, 3);
            let tanggal = val.slice(3, 11);
            let nomor = val.slice(11);
            
            let formatted = "";
            
            if (prefix) formatted += prefix;
            if (tanggal) formatted += "-" + tanggal;
            if (nomor) formatted += "-" + nomor;
            
            this.value = formatted;
        });

        // Handle form submit
        document.getElementById('trackingForm').addEventListener('submit', function(e) {
            const nota = document.getElementById('nota').value.trim();
            
            if (!nota) {
                e.preventDefault();
                Swal.fire({
                    icon: "warning",
                    confirmButtonColor: "#667eea",
                    title: "Peringatan",
                    text: "Harap masukkan kode order!",
                    timer: 2000,
                    timerProgressBar: true,
                });
                return false;
            }
        });
    </script>
</body>
</html>