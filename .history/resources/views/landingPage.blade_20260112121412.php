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
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-lg z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-12 w-auto opacity-80">
                    <a href="#beranda">
                        <span class="text-2xl font-bold text-gray-900">D`Laundry</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-10">
                    <a href="#layanan" class="text-gray-700 hover:text-purple-600 font-medium transition">Layanan</a>
                    <a href="#harga" class="text-gray-700 hover:text-purple-600 font-medium transition">Harga</a>
                    <a href="#tracking" class="text-gray-700 hover:text-purple-600 font-medium transition">Tracking</a>
                    <a href="#keunggulan" class="text-gray-700 hover:text-purple-600 font-medium transition">Keunggulan</a>
                    <a href="#testimoni" class="text-gray-700 hover:text-purple-600 font-medium transition">Testimoni</a>
                    <a href="/order-now"
   class="text-gray-700 hover:text-purple-600 transition flex items-center"
   aria-label="Keranjang Belanja">
  <svg xmlns="http://www.w3.org/2000/svg"
       viewBox="0 0 24 24"
       fill="none"
       stroke="currentColor"
       stroke-width="1.8"
       stroke-linecap="round"
       stroke-linejoin="round"
       class="w-6 h-6">
    <!-- Keranjang -->
    <path d="M3 3h2l2.5 12h10l2-8H6.5" />
    <!-- Roda kiri -->
    <circle cx="9" cy="20" r="1" />
    <!-- Roda kanan -->
    <circle cx="17" cy="20" r="1" />
  </svg>
</a>

                </div>

                <a href="/customer-login" class="gradient-primary text-white px-7 py-2.5 rounded-xl font-semibold hover:opacity-90 transition shadow-lg">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-32 pb-24 gradient-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="text-white fade-in">
                    {{-- <div class="inline-flex items-center glass-card px-5 py-2.5 rounded-full mb-8 shadow-xl">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-3 animate-pulse"></span>
                        <span class="text-sm font-medium text-gray-800">Sistem Laundry Terpercaya</span>
                    </div> --}}

                    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                        Laundry Jadi<br/>
                        <span class="text-yellow-300">Mudah & Cepat</span>
                    </h1>

                    <p class="text-xl mb-10 text-purple-100 leading-relaxed">
                        Tempat laundry modern dengan tracking real-time,
                        proses cepat, dan hasil yang memuaskan.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#layanan" class="bg-white text-black px-10 py-4 rounded-xl font-bold text-lg hover:bg-purple-50 transition shadow-2xl text-center">
                            Lihat Layanan
                        </a>
                        <a href="#tracking" class="bg-white text-black px-10 py-4 rounded-xl font-bold text-lg hover:bg-purple-50 transition shadow-2xl text-center">
                            Cek Status
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
                    {{-- <svg class="w-10 h-10 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg> --}}
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
                    {{-- <svg class="w-10 h-10 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg> --}}
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
                    {{-- <svg class="w-10 h-10 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg> --}}
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

    <!-- Pricing Section -->
    <section id="harga" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Daftar Harga</h2>
                <p class="text-xl text-gray-600">Harga transparan tanpa biaya tersembunyi</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Pricing Card 1 -->
                <div class="bg-white rounded-3xl p-10 border-0 border-purple-200 hover-scale">
                    <div class="flex items-center gap-3 mb-8">
                        <h3 class="text-3xl font-bold text-gray-900">Paket Kiloan</h3>
                    </div>

                    <div class="space-y-5 mb-8">
                        @foreach($dataLayananKiloan as $kiloan)
                            <div class="flex justify-between items-center p-4 bg-white-100 border-1 border-purple-300 rounded-xl">
                                <span class="text-gray-700 font-medium">{{ $kiloan->nama_layanan }}</span>
                                <span class="text-xl font-bold gradient-text">Rp {{number_format($kiloan->harga,0,',' , '.')}}/kg</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pricing Card 2 -->
                <div class="bg-white rounded-3xl p-10 border-0 border-orange-200 hover-scale">
                    <div class="flex items-center gap-3 mb-8">
                        <h3 class="text-3xl font-bold text-gray-900">Paket Satuan</h3>
                    </div>

                    <div class="space-y-5 mb-8">
                        @foreach($dataLayananSatuan as $satuan)
                            <div class="flex justify-between items-center p-4 bg-white-100 border-1 border-yellow-300 rounded-xl">
                                <span class="text-gray-700 font-medium">{{ $satuan->nama_layanan }}</span>
                                <span class="text-xl font-bold text-orange-600">Rp {{ number_format($satuan->harga,0,',','.') }}/pcs</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Section -->
    <section id="tracking" class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Lacak Cucian Anda</h2>
                <p class="text-xl text-gray-600">Masukkan kode order untuk melihat status real-time</p>
            </div>

            <div class="bg-white rounded-3xl p-12 shadow-2xl border border-gray-100">
                <form id="trackingForm" class="space-y-6">
                    @csrf
                    <div>
                        <label for="nota" class="block text-sm font-bold text-gray-700 mb-3">Kode Order</label>
                        <input
                            type="text"
                            id="nota"
                            name="nota"
                            placeholder="Contoh: ORD-20241205-001"
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
                        {{-- <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center flex-shrink-0"> --}}
                            <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        {{-- </div> --}}
                        <div>
                            <p class="font-bold text-gray-900 mb-1">Tips Penting</p>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Nomor kode order tercantum pada struk yang Anda terima saat menyerahkan cucian.
                                Simpan struk dengan baik untuk memudahkan tracking dan pengambilan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Result Modal -->
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
                                <span id="resultStatusBadge" class="px-4 py-2 rounded-full text-sm font-bold uppercase"></span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div class="bg-white p-4 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    {{-- <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"> --}}
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    {{-- </div> --}}
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Masuk</p>
                                        <p id="resultTanggalMasuk" class="font-bold text-gray-900"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    {{-- <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center"> --}}
                                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    {{-- </div> --}}
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
                                {{-- <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center"> --}}
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                {{-- </div> --}}
                                <h4 class="text-lg font-bold text-gray-900">Nama Pelanggan</h4>
                            </div>
                            <p id="resultNamaPelanggan" class="text-md font-small text-gray-900"></p>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center space-x-3 mb-4">
                                {{-- <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"> --}}
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                {{-- </div> --}}
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
                            {{-- <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div> --}}
                            <h4 class="text-lg font-bold text-gray-900">Riwayat Status</h4>
                        </div>

                        <div id="statusTimeline" class="space-y-4">
                            <!-- Timeline akan diisi via JavaScript -->
                        </div>
                    </div>

                    <!-- Catatan (if exists) -->
                    <div id="catatanContainer" class="hidden border border-gray-200 rounded-2xl p-6">
                        <div class="flex items-start space-x-3">
                            {{-- <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0"> --}}
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            {{-- </div> --}}
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">Catatan Khusus</h4>
                                <p id="resultCatatan" class="text-gray-700"></p>
                            </div>
                        </div>
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
                    {{-- <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6"> --}}
                        <svg class="w-8 h-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    {{-- </div> --}}
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Proses Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Proses pencucian yang cepat dan teratur memastikan pakaian Anda selesai tepat waktu.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    {{-- <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6"> --}}
                        <svg class="w-8 h-8 text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    {{-- </div> --}}
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Jaminan Kualitas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Menggunakan deterjen berkualitas tinggi dan proses pencucian standar premium untuk hasil maksimal.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    {{-- <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6"> --}}
                        <svg class="w-8 h-8 text-purple-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    {{-- </div> --}}
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Penanganan Hati-Hati</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Setiap pakaian ditangani secara teliti agar tetap bersih, harum, dan tidak rusak.
                    </p>
                </div>

                 <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                    {{-- <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6"> --}}
                        <svg class="w-8 h-8 text-yellow-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                    {{-- </div> --}}
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Tepat Waktu</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Komitmen kami adalah menyelesaikan cucian sesuai jadwal yang dijanjikan tanpa molor.
                    </p>
                </div>

            <!-- 5. Harga Terjangkau -->
            <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                {{-- <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6"> --}}
                    <svg class="w-8 h-8 text-red-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                {{-- </div> --}}
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Harga Terjangkau</h3>
                <p class="text-gray-600 leading-relaxed">
                    Harga yang ramah di kantong dengan kualitas pengerjaan yang tetap maksimal.
                </p>
            </div>

            <!-- 6. Garansi Pakaian Hilang -->
            <div class="bg-white rounded-3xl p-10 hover-scale shadow-lg">
                {{-- <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6"> --}}
                    <svg class="w-8 h-8 text-indigo-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0z"></path>
                    </svg>
                {{-- </div> --}}
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
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
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
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
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
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-12 w-auto opacity-80">
                        <span class="text-2xl font-bold text-white">D`Laundry</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Sistem manajemen laundry modern yang memudahkan hidup Anda.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-4">Layanan</h4>
                    <ul class="space-y-3">
                        @foreach($top4Layanan as $layananList)
                            <li><a href="#layanan" class="hover:text-purple-400 transition">{{ $layananList->nama_layanan }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-400">Jl. Bandung No. 123, Kota Kembang</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-purple-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-400">dlaundry@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-purple-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-400">+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </footer>

    <!-- Smooth Scroll Script -->
    <script>
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
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Data Tidak Ditemukan!",
                timer:2000,
                timerProgressBar: true,
            });
            // alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // alert('Terjadi kesalahan. Silakan coba lagi.');
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
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
    document.getElementById('resultStatusBadge').className = `${config.badgeClass} px-4 py-2 rounded-full text-sm font-bold uppercase`;

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
                            <p class="text-sm text-gray-500 mt-1">${formatDate(log.tanggal_ubah)} WIB</p>
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
</script>
<script>
    document.getElementById("nota").addEventListener("input", function () {
        let val = this.value.replace(/-/g, ""); // hapus semua "-"

        let prefix = val.slice(0, 3);       // ORD
        let tanggal = val.slice(3, 11);     // 20251130
        let nomor = val.slice(11, 14);      // 002

        let formatted = "";

        if (prefix) formatted += prefix;
        if (tanggal) formatted += "-" + tanggal;
        if (nomor) formatted += "-" + nomor;

        // this.value = formatted;
        this.value = formatted.toUpperCase();
    });
</script>
</body>
</html>
