<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D`Laundry</title>
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
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

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
    <style>
    /* Existing styles... */

    .service-price-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .service-price-card.selected {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25) !important;
        transform: translateY(-4px) !important;
    }

    .service-price-card.selected .selected-indicator {
        display: block !important;
    }

    .service-price-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.15);
    }
</style>
</head>
<body class="bg-gray-50">

    @include('landingPageComponent.navbar')

    <!-- Hero Section -->
    <section id="beranda" class="pt-32 pb-24 gradient-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="text-white fade-in">
                    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                        Gak Sempat Nyuci?<br/>
                        <span class="text-yellow-300">Kami Urus!</span>
                    </h1>

                    <p class="text-xl mb-10 text-purple-100 leading-relaxed">
                        Tinggal pesan, serahkan cucian, dan pantau progresnya online. Lebih praktis, lebih tenang.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/customer-orders" class="bg-white text-black px-10 py-4 rounded-xl font-bold text-lg hover:bg-purple-50 transition shadow-2xl text-center">
                            Pesan Sekarang
                        </a>
                        <a href="#tracking" class="bg-white text-black px-10 py-4 rounded-xl font-bold text-lg hover:bg-purple-50 transition shadow-2xl text-center">
                            Lacak Cucian
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Bottom -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100L60 88.3C120 76.7 240 53.3 360 40C480 26.7 600 23.3 720 30C840 36.7 960 53.3 1080 60C1200 66.7 1320 63.3 1380 61.7L1440 60V100H1380C1320 100 1200 100 1080 100C960 100 840 100 720 100C600 100 480 100 360 100C240 100 120 100 60 100H0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Layanan Kami</h2>
                <p class="text-xl text-gray-600">Pilih layanan yang sesuai dengan kebutuhanmu</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg border border-gray-100">
                    <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-12 w-auto opacity-80 mb-3">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Cuci Kiloan</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Layanan cuci pakaian per kilogram dengan harga terjangkau. Cocok untuk kebutuhan sehari-hari.
                    </p>
                    <div class="gradient-text text-2xl font-bold">Rp 8.000<span class="text-gray-500 text-lg">/kg</span></div>
                    <p class="text-sm text-gray-500 mt-2">Selesai 2-3 hari</p>
                </div>

                <!-- Service 2 -->
                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg border-2 border-purple-200">
                    <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-12 w-auto opacity-80 mb-3">
                    <div class="flex items-center gap-2 mb-3">
                        <h3 class="text-2xl font-bold text-gray-900">Cuci Express</h3>
                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">POPULER</span>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Layanan kilat untuk kebutuhan mendesak. Proses cepat tanpa mengurangi kualitas hasil.
                    </p>
                    <div class="gradient-text text-2xl font-bold">Rp 15.000<span class="text-gray-500 text-lg">/kg</span></div>
                    <p class="text-sm text-gray-500 mt-2">Selesai 12 jam</p>
                </div>

                <!-- Service 3 -->
                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg border border-gray-100">
                    <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-12 w-auto opacity-80 mb-3">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Cuci Satuan</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Perawatan khusus untuk pakaian spesial seperti jas, gaun, sepatu, dan item bernilai tinggi.
                    </p>
                    <div class="gradient-text text-2xl font-bold">Rp 25.000<span class="text-gray-500 text-lg">/pcs</span></div>
                    <p class="text-sm text-gray-500 mt-2">Perawatan Premium</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section (Updated) -->
    <section id="harga" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Daftar Harga</h2>
                <p class="text-xl text-gray-600">Pilih layanan favorit Anda dan tambahkan ke keranjang</p>
            </div>

            <!-- Service Grid (6 items, 2 rows x 3 cols) -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                @foreach($top6Layanan as $layanan)
                <div class="service-price-card bg-white rounded-2xl p-6 border-2 border-gray-100 hover:border-purple-300 hover-scale cursor-pointer transition-all"
                    data-price-service-id="{{ $layanan->id_layanan }}"
                    onclick="togglePriceService('{{ $layanan->id_layanan }}', this)">
                    
                    <!-- Image Section -->
                    <div class="mb-4">
                        <div class="w-full h-40 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center border-2 border-gray-200">
                            @if($layanan->foto && $layanan->foto !== '')
                                <img src="{{ asset('storage/' . $layanan->foto) }}" 
                                    alt="{{ $layanan->nama_layanan }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='{{ asset('image/d_laundry.png') }}';">
                            @else
                                <img src="{{ asset('image/d_laundry.png') }}" 
                                    alt="{{ $layanan->nama_layanan }}"
                                    class="max-w-[80%] max-h-[80%] object-contain">
                            @endif
                        </div>
                    </div>

                    <!-- Service Info -->
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-lg font-bold text-gray-900">{{ $layanan->nama_layanan }}</h4>
                        <span class="px-3 py-1 {{ $layanan->jenis == 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }} rounded-full text-xs font-bold uppercase">
                            {{ $layanan->jenis }}
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <div class="text-2xl font-bold gradient-text">
                            Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                            <span class="text-gray-500 text-base">/{{ $layanan->jenis == 'kiloan' ? 'kg' : 'pcs' }}</span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <p class="text-sm text-gray-500 flex items-center">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $layanan->jumlah_transaksi ?? 0 }} transaksi
                    </p>
                </div>
                @endforeach
            </div>

            <!-- Lihat Katalog Button -->
            <div class="text-center mt-12">
                <a href="/catalog" class="inline-flex items-center gap-3 gradient-primary text-white px-10 py-5 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Katalog Lengkap
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Tracking Section (Updated to match tracking page) -->
    <section id="tracking" class="py-24 bg-gray-50">
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

            <!-- Result Modal (sama seperti di tracking page) -->
            <div id="trackingResult" class="hidden mt-8 bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Status Cucian Anda</h3>
                        <p class="text-sm text-gray-500 mt-1">Informasi real-time pesanan laundry</p>
                    </div>
                    <button onclick="closeTrackingResult()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <!-- Order Info Header -->
                    <div class="bg-white-100 p-6 rounded-2xl border border-purple-200">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Kode Order</p>
                                <p id="resultKodeOrder" class="text-3xl font-bold text-gray-600"></p>
                            </div>
                            <div class="text-right">
                                <span id="resultStatusBadge" class="status-badge"></span>
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
                                        <p id="resultTanggalMasuk" class="font-bold text-gray-900"></p>
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
                                        <p id="resultTanggalSelesai" class="font-bold text-gray-900"></p>
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
                            <p id="resultNamaPelanggan" class="text-md font-small text-gray-900"></p>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <h4 class="text-lg font-bold text-gray-900">Layanan</h4>
                            </div>
                            <div class="flex items-center space-x-3">
                                <p id="resultNamaLayanan" class="text-md font-small text-gray-900"></p>
                                <span hidden id="resultJenisLayanan" class="px-3 py-1 rounded-full text-xs font-bold uppercase"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Status Timeline -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <h4 class="text-lg font-bold text-gray-900">Riwayat Status</h4>
                        </div>

                        <div id="statusTimeline" class="space-y-4">
                            <!-- Timeline akan diisi via JavaScript -->
                        </div>
                    </div>

                    <!-- Catatan (if exists) -->
                    <div id="catatanContainer" class="hidden border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">Catatan Khusus</h4>
                                <p id="resultCatatan" class="text-gray-700"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button onclick="closeTrackingResult()" class="flex-1 text-center px-6 py-4 bg-white border-2 border-purple-600 text-purple-600 rounded-2xl font-bold hover:bg-purple-50 transition">
                            Tutup
                        </button>

                        <a href="/tracking" class="flex-1 text-center px-6 py-4 gradient-primary text-white rounded-2xl font-bold hover:opacity-90 transition shadow-xl">
                            Lihat Detail Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="keunggulan" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Kenapa Pilih Kami?</h2>
                <p class="text-xl text-gray-600">Keunggulan yang membuat kami berbeda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    <svg class="w-8 h-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Proses Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Proses pencucian yang cepat dan teratur memastikan pakaian Anda selesai tepat waktu.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    <svg class="w-8 h-8 text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Jaminan Kualitas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Menggunakan deterjen berkualitas tinggi dan proses pencucian standar premium untuk hasil maksimal.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    <svg class="w-8 h-8 text-purple-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Penanganan Hati-Hati</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Setiap pakaian ditangani secara teliti agar tetap bersih, harum, dan tidak rusak.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    <svg class="w-8 h-8 text-yellow-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Tepat Waktu</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Komitmen kami adalah menyelesaikan cucian sesuai jadwal yang dijanjikan tanpa molor.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    <svg class="w-8 h-8 text-red-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Harga yang ramah di kantong dengan kualitas pengerjaan yang tetap maksimal.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    <svg class="w-8 h-8 text-indigo-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Garansi Pakaian Hilang</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Setiap item dicatat dan ditimbang dengan jelas. Jika terjadi kehilangan, kami siap bertanggung jawab.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimoni" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Kata Mereka</h2>
                <p class="text-xl text-gray-600">Testimoni pelanggan setia kami</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-3xl p-8 hover-scale border border-purple-100">
                    <div class="flex items-center gap-2 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed italic">
                        "Pelayanan sangat cepat dan hasilnya bersih wangi! Sistem tracking-nya juga memudahkan untuk pantau status cucian. Recommended banget!"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center text-white font-bold text-lg">
                            AS
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Andini Saraswati</p>
                            <p class="text-sm text-gray-500">Mahasiswi</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 hover-scale border border-green-100">
                    <div class="flex items-center gap-2 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed italic">
                        "Setiap kali bawa cucian ke sini, hasilnya selalu memuaskan. Pakaian disetrika rapi, lipatannya bersih, dan wanginya tahan lama. Tempat terbaik buat langganan!"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            BP
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Budi Prasetyo</p>
                            <p class="text-sm text-gray-500">Karyawan Swasta</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-3xl p-8 hover-scale border border-orange-100">
                    <div class="flex items-center gap-2 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed italic">
                        "Layanan cuci satuan untuk jas kerja saya hasilnya sempurna! Rapi dan wangi. Pasti jadi langganan saya terus."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-yellow-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            CH
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Citra Handayani</p>
                            <p class="text-sm text-gray-500">Pengusaha</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landingPageComponent.footer')

    <!-- JavaScript sama seperti sebelumnya -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const services = @json($dataLayanan);
        const BASE_STORAGE = "{{ asset('storage') }}";
        const BASE_IMAGE = "{{ asset('image') }}";
    </script>
    <script>
         // ========== FUNGSI HELPER ==========
        function getServiceImage(service) {
            if (service.foto && service.foto.trim() !== '') {
                return `${BASE_STORAGE}/${service.foto}`;
            }
            return `${BASE_IMAGE}/d_laundry.png`;
        }

        function getServiceImageClass(service) {
            if (service.foto) {
                return 'w-full h-full object-cover';
            }
            return 'max-w-[80%] max-h-[80%] object-contain';
        }
    </script>
    <script>
        // Fungsi untuk mendapatkan konfigurasi status
        function getStatusConfig(status) {
            const configs = {
                'menunggu': {
                    label: 'Menunggu Diproses',
                    icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                    bg: 'bg-yellow-100',
                    text: 'text-yellow-600',
                    border: 'border-yellow-200',
                    badgeClass: 'bg-yellow-100 text-yellow-700'
                },
                'diproses': {
                    label: 'Sedang Diproses',
                    icon: 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                    bg: 'bg-blue-100',
                    text: 'text-blue-600',
                    border: 'border-blue-200',
                    badgeClass: 'bg-blue-100 text-blue-700'
                },
                'dicuci': {
                    label: 'Sedang Dicuci',
                    icon: 'M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm7 14a5 5 0 110-10 5 5 0 010 10z M12 8a4 4 0 100 8 4 4 0 000-8z',
                    bg: 'bg-orange-100',
                    text: 'text-orange-600',
                    border: 'border-orange-200',
                    badgeClass: 'bg-orange-100 text-orange-700'
                },
                'disetrika': {
                    label: 'Sedang Disetrika',
                    icon: 'M13 10V3L4 14h7v7l9-11h-7z',
                    bg: 'bg-purple-100',
                    text: 'text-purple-600',
                    border: 'border-purple-200',
                    badgeClass: 'bg-purple-100 text-purple-700'
                },
                'ready': {
                    label: 'Siap Diambil',
                    icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    bg: 'bg-green-100',
                    text: 'text-green-600',
                    border: 'border-green-200',
                    badgeClass: 'bg-green-100 text-green-700'
                },
                'diambil': {
                    label: 'Selesai & Diambil',
                    icon: 'M5 13l4 4L19 7',
                    bg: 'bg-gray-100',
                    text: 'text-gray-600',
                    border: 'border-gray-200',
                    badgeClass: 'bg-gray-100 text-gray-700'
                },
                'dibatalkan': {
                    label: 'Order Dibatalkan',
                    icon: 'M6 18L18 6M6 6l12 12',
                    bg: 'bg-red-100',
                    text: 'text-red-600',
                    border: 'border-red-200',
                    badgeClass: 'bg-red-100 text-red-700'
                }
            };

            return configs[status] || {
                label: status.charAt(0).toUpperCase() + status.slice(1),
                icon: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                bg: 'bg-gray-100',
                text: 'text-gray-600',
                border: 'border-gray-200',
                badgeClass: 'bg-gray-100 text-gray-700'
            };
        }

        // Format tanggal
        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
            return date.toLocaleDateString('id-ID', options).replace(',', ',');
        }

        // Handle form submit
        document.getElementById('trackingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const nota = document.getElementById('nota').value.trim();
            const button = this.querySelector('button[type="submit"]');
            const originalButtonText = button.innerHTML;

            // Disable button dan ubah text
            button.disabled = true;
            button.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mencari...
            `;

            // Kirim request
            fetch('/tracking/check', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ nota: nota })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayTrackingResult(data.data);
                } else {
                    Swal.fire({
                        icon: "warning",
                        confirmButtonColor: "#667eea",
                        title: "Peringatan",
                        text: "Data Tidak Ditemukan!",
                        timer:2000,
                        timerProgressBar: true,
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: "warning",
                    confirmButtonColor: "#667eea",
                    title: "Peringatan",
                    text: "Harap Masukan Kode Order Yang Sesuai!",
                    timer:2000,
                    timerProgressBar: true,
                });
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalButtonText;
            });
        });

        // Display tracking result
        function displayTrackingResult(data) {
            const order = data.order;
            const statusLogs = data.statusLogs;
            const config = getStatusConfig(order.status_order);

            // Set basic info
            document.getElementById('resultKodeOrder').textContent = order.kode_order;
            document.getElementById('resultStatusBadge').textContent = order.status_order;
            document.getElementById('resultStatusBadge').className = `status-badge ${config.badgeClass}`;

            document.getElementById('resultTanggalMasuk').textContent = formatDate(order.tanggal_masuk).split(',')[0];
            document.getElementById('resultTanggalSelesai').textContent = formatDate(order.tanggal_selesai).split(',')[0];

            document.getElementById('resultNamaPelanggan').textContent = order.nama;
            document.getElementById('resultNamaLayanan').textContent = order.nama_layanan;

            const jenisSpan = document.getElementById('resultJenisLayanan');
            jenisSpan.textContent = order.jenis;
            jenisSpan.className = `${order.jenis === 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700'} px-3 py-1 rounded-full text-xs font-bold uppercase`;

            // Catatan
            if (order.catatan) {
                document.getElementById('catatanContainer').classList.remove('hidden');
                document.getElementById('resultCatatan').textContent = order.catatan;
            } else {
                document.getElementById('catatanContainer').classList.add('hidden');
            }

            // Build timeline
            const timeline = document.getElementById('statusTimeline');
            timeline.innerHTML = '';

            statusLogs.forEach((log, index) => {
                const logConfig = getStatusConfig(log.status);
                const isLast = index === statusLogs.length - 1;

                const timelineItem = `
                    <div class="flex items-start space-x-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 ${logConfig.bg} rounded-full flex items-center justify-center border-2 ${logConfig.border}">
                                <svg class="w-5 h-5 ${logConfig.text}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${logConfig.icon}"></path>
                                </svg>
                            </div>
                            ${!isLast ? '<div class="w-0.5 h-16 bg-gray-300"></div>' : ''}
                        </div>
                        <div class="flex-1 ${!isLast ? 'pb-4' : ''}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 text-base">${logConfig.label}</p>
                                    <p class="text-sm text-gray-500 mt-1">${formatDate(log.tanggal_ubah)}</p>
                                </div>
                                ${index === 0 ? `<span class="px-3 py-1 ${logConfig.bg} ${logConfig.text} rounded-full text-xs font-bold uppercase">Terbaru</span>` : ''}
                            </div>
                        </div>
                    </div>
                `;

                timeline.innerHTML += timelineItem;
            });

            // Show result
            document.getElementById('trackingResult').classList.remove('hidden');
            document.getElementById('trackingResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Close tracking result
        function closeTrackingResult() {
            document.getElementById('trackingResult').classList.add('hidden');
            document.getElementById('nota').value = '';
        }

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

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    <script>
        // ========== PRICE SERVICE SELECTION (dari Landing Page) ==========
function togglePriceService(id, card) {
    const service = services.find(s => s.id_layanan === id);
    if (!service) return;

    const exists = selectedServices.find(s => s.id_layanan === id);

    if (exists) {
        // Remove from cart
        selectedServices = selectedServices.filter(s => s.id_layanan !== id);
        card.classList.remove('selected');
        
        // Swal.fire({
        //     icon: 'info',
        //     title: 'Dihapus dari Keranjang',
        //     text: `${service.nama_layanan} telah dihapus`,
        //     timer: 1500,
        //     showConfirmButton: false
        // });
    } else {
        // Add to cart
        selectedServices.push({
            id_layanan: service.id_layanan,
            name: service.nama_layanan,
            price: Number(service.harga),
            quantity: 1
        });
        card.classList.add('selected');
        
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Ditambahkan ke Keranjang!',
        //     text: `${service.nama_layanan} berhasil ditambahkan`,
        //     timer: 1500,
        //     showConfirmButton: false
        // });
    }

    updateCartCounter();
    console.log('Selected Services:', selectedServices);
}

// ========== FUNGSI CART COUNTER (jika belum ada) ==========
function updateCartCounter() {
    const cartCount = selectedServices.reduce((sum, s) => sum + s.quantity, 0);

    localStorage.setItem('cartCount', cartCount);
    localStorage.setItem('cartItems', JSON.stringify(selectedServices));

    const event = new CustomEvent('cartUpdated', {
        detail: { count: cartCount }
    });
    window.dispatchEvent(event);
}

// ========== INISIALISASI SAAT PAGE LOAD ==========
document.addEventListener('DOMContentLoaded', function() {
    // Load cart dari localStorage
    const savedCart = localStorage.getItem('cartItems');
    if (savedCart) {
        selectedServices = JSON.parse(savedCart);
        
        // Restore selected state untuk price cards
        selectedServices.forEach(selectedService => {
            const card = document.querySelector(`[data-price-service-id="${selectedService.id_layanan}"]`);
            if (card) {
                card.classList.add('selected');
            }
        });
        
        updateCartCounter();
    }
});// ========== PRICE SERVICE SELECTION (dari Landing Page) ==========
function togglePriceService(id, card) {
    const service = services.find(s => s.id_layanan === id);
    if (!service) return;

    const exists = selectedServices.find(s => s.id_layanan === id);

    if (exists) {
        // Remove from cart
        selectedServices = selectedServices.filter(s => s.id_layanan !== id);
        card.classList.remove('selected');
        
        // Swal.fire({
        //     icon: 'info',
        //     title: 'Dihapus dari Keranjang',
        //     text: `${service.nama_layanan} telah dihapus`,
        //     timer: 1500,
        //     showConfirmButton: false
        // });
    } else {
        // Add to cart
        selectedServices.push({
            id_layanan: service.id_layanan,
            name: service.nama_layanan,
            price: Number(service.harga),
            quantity: 1
        });
        card.classList.add('selected');
        
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Ditambahkan ke Keranjang!',
        //     text: `${service.nama_layanan} berhasil ditambahkan`,
        //     timer: 1500,
        //     showConfirmButton: false
        // });
    }

    updateCartCounter();
    console.log('Selected Services:', selectedServices);
}

// ========== FUNGSI CART COUNTER (jika belum ada) ==========
function updateCartCounter() {
    const cartCount = selectedServices.reduce((sum, s) => sum + s.quantity, 0);

    localStorage.setItem('cartCount', cartCount);
    localStorage.setItem('cartItems', JSON.stringify(selectedServices));

    const event = new CustomEvent('cartUpdated', {
        detail: { count: cartCount }
    });
    window.dispatchEvent(event);
}

// ========== INISIALISASI SAAT PAGE LOAD ==========
document.addEventListener('DOMContentLoaded', function() {
    // Load cart dari localStorage
    const savedCart = localStorage.getItem('cartItems');
    if (savedCart) {
        selectedServices = JSON.parse(savedCart);
        
        // Restore selected state untuk price cards
        selectedServices.forEach(selectedService => {
            const card = document.querySelector(`[data-price-service-id="${selectedService.id_layanan}"]`);
            if (card) {
                card.classList.add('selected');
            }
        });
        
        updateCartCounter();
    }
});
    </script>
</body>
</html>
