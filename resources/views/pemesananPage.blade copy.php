<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D`Laundry - Orders</title>
    <!-- Favicon -->
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        />
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

        .gradient-border {
            background:
                linear-gradient(#ffffff, #ffffff) padding-box,
                linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
        }

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .step-content {
            display: none;
        }
        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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

        .service-card.selected {
            border-color: #7c3aed; /* purple-600 */
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25);
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    @include('landingPageComponent.navbar')

    <!-- Main Content -->
    <section class="pt-32 pb-24 bg-gray-50 min-h-screen">
        <div class="max-w-8xl mx-auto px-5 sm:px-7 lg:px-7">
            <!-- Progress Indicator -->
            <div class="mb-12 fade-in">
                <div class="flex items-center justify-center">
                    <!-- Step 1: Informasi Pemesanan -->
                    <div class="flex flex-col items-center">
                        <div id="progress-step-1" class="w-20 h-20 gradient-primarys rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <span id="label-step-1" class="mt-3 font-semibold text-purple-600 text-sm">Info Pemesanan</span>
                    </div>

                    <!-- Line Connector 1 -->
                    <div id="line-1" class="w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4"></div>

                    <!-- Step 2: Layanan -->
                    <div class="flex flex-col items-center">
                        <div id="progress-step-2" class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span id="label-step-2" class="mt-3 font-medium text-gray-400 text-sm">Layanan</span>
                    </div>

                    <!-- Line Connector 2 -->
                    <div id="line-2" class="w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4"></div>

                    <!-- Step 3: Ringkasan -->
                    <div class="flex flex-col items-center">
                        <div id="progress-step-3" class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span id="label-step-3" class="mt-3 font-medium text-gray-400 text-sm">Ringkasan</span>
                    </div>
                </div>
            </div>

            <!-- Order Form -->
            <div id="step-1" class="step-content active bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                <!-- Section: Alamat Pickup -->
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Alamat Pickup</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Alamat</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <button class="tab-button active px-6 py-3 rounded-xl font-semibold border-2 border-gray-200">
                                    Rumah
                                </button>
                                <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700">
                                    Kost
                                </button>
                                <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700">
                                    Kantor
                                </button>
                                <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700">
                                    Hotel
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                            <div class="relative">
                                <input type="text" id="address" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-base"
                                >
                            </div>
                        </div>

                        {{-- <div class="bg-gray-100 rounded-2xl overflow-hidden" style="height: 300px;">
                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                <div class="text-center">
                                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <p class="font-medium">Peta akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div> --}}

                        <div
                            id="map"
                            class="w-full h-[360px] rounded-2xl"
                            {{-- style="height: 400px;" --}}
                        ></div>


                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Instruksi Alamat (Opsional)</label>
                            <textarea
                                placeholder="Contoh: Rumah cat hijau, dekat warung Pak Budi"
                                rows="3"
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition resize-none"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Section: Informasi Kontak -->
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Informasi Kontak</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kontak</label>
                            <div class="grid grid-cols-2 gap-3">
                                <button onclick="ChooseYourTypeOfContect('Individu')" class="tab-button active px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Individu
                                </button>
                                <button onclick="ChooseYourTypeOfContect('Perusahaan')" class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Perusahaan
                                </button>
                            </div>
                        </div>

                        <div id="idHiddenPerusahaan" hidden class="grid md:grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Perusahaan</label>
                                <input type="text" id="id_namaPerusahaan" placeholder="Nama Perusahaan" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Depan</label>
                                <input type="text" id="firstName"
                                    placeholder="Nama depan"
                                    value="{{ $firstName }}"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Belakang</label>
                                <input type="text"
                                    placeholder="Nama belakang" id="lastName"
                                    value="{{ $lastName }}"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                            <div class="flex gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="L" {{ $gender === 'L' || $gender == null ? 'checked' : '' }} class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                    <span class="font-medium text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="P" {{ $gender === 'P' ? 'checked' : '' }} class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                    <span class="font-medium text-gray-700">Perempuan</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                <div class="flex gap-2">
                                    <div class="w-20 px-4 py-4 border-2 border-gray-200 rounded-2xl bg-gray-50 flex items-center justify-center font-semibold text-gray-700">
                                        +62
                                    </div>
                                    <input type="tel"
                                        value="{{ $noHp }}"
                                        placeholder="Masukkan nomor telepon" id="phone"
                                        class="flex-1 px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email"
                                    placeholder="email@example.com"
                                    value="{{ $email }}"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                >
                            </div>
                        </div>

                        <div class="bg-blue-50 border-2 border-blue-200 rounded-2xl p-4">
                            <p class="text-sm text-blue-800">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                Informasi kontak akan digunakan untuk update status pesanan dan komunikasi dengan driver.
                            </p>
                        </div>
                    </div>
                </div>

                @guest('pelanggan')
                    <!-- Section: Buat Akun -->
                    <div class="p-8 border-b border-gray-200">
                        <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-6 border-2 border-purple-100">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Buat akun baru otomatis?</h3>
                                    <ul class="space-y-2 mb-4">
                                        <li class="flex items-center gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Bisa pantau & simpan transaksi
                                        </li>
                                        <li class="flex items-center gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Lebih dulu tau info promo seru
                                        </li>
                                        <li class="flex items-center gap-2 text-sm text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Mudah hubungi bantuan jika ada kendala
                                        </li>
                                    </ul>
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" class="w-5 h-5 rounded text-purple-600 focus:ring-purple-500 rounded-2xl border-gray-300">
                                        <span class="font-semibold text-gray-900">Ya, dengan buat akun D`Laundry, kamu menyetujui Syarat dan Ketentuan & Kebijakan Privasi</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border border-gray-300 rounded-2xl p-5">
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-semibold text-gray-900">Sudah punya akun?</p>
                                <button onclick="DirectToLoginView()" class="text-purple-600 items-center justify-center border border-purple-600 rounded-2xl py-2 px-5 font-bold hover:text-purple-700 transition">
                                    Login Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                @endguest

                <!-- Section: Jadwal Pickup -->
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Mau di pickup kapan?</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Hari apa?</label>
                            <div class="relative">
                                <input type="date" id="pickupDate" value="{{ $currentlyDate }}" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl bg-white focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition cursor-pointer">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jam berapa?</label>
                            <select id="pickupTime" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition appearance-none bg-white cursor-pointer">
                                <option value="">Pilih slot waktu</option>
                                <option value="09:00-11:00">09:00 - 11:00</option>
                                <option value="11:00-13:00">11:00 - 13:00</option>
                                <option value="13:00-15:00">13:00 - 15:00</option>
                                <option value="15:00-17:00">15:00 - 17:00</option>
                                <option value="17:00-19:00">17:00 - 19:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 bg-yellow-50 border-2 border-yellow-200 rounded-2xl p-4">
                        <p class="text-sm font-medium text-yellow-800">
                            <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <strong>Informasi Penting:</strong> Pastikan pakaian yang di berikan kepada kami telah di kemas dengan baik.
                        </p>
                    </div>
                </div>

                <!-- Section: Instruksi Driver -->
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Instruksi untuk Driver</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <select class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition appearance-none bg-white cursor-pointer">
                                <option value="">Antar kepada saya langsung</option>
                                <option value="security">Tinggalkan di pos satpam</option>
                                <option value="neighbor">Titip ke tetangga</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="p-8 bg-gray-50 rounded-b-3xl">
                    <button onclick="nextStep()" class="w-full gradient-primary text-white px-8 py-5 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-xl flex items-center justify-center gap-3">
                        <span>Lanjut ke Layanan</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Step 2: Layanan -->
            <div id="step-2" class="step-content">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                    <div class="p-8 border-b border-gray-200">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Pilih Layanan</h2>
                        </div>
                        <p class="text-gray-600">Pilih jenis layanan yang Anda butuhkan</p>
                    </div>

                    <!-- Service Grid -->
                    <div class="p-8">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6" id="serviceGrid">
                            <!-- Service Cards will be generated by JavaScript -->
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="p-8 pt-4">
                        <div class="flex gap-4">
                            <button onclick="prevStep()"
                                class="flex-1 px-8 py-4 rounded-2xl font-bold text-lg
                                    text-purple-600 transition
                                    bg-white
                                    border-2 border-transparent
                                    bg-origin-border bg-clip-padding
                                    hover:bg-purple-100
                                    gradient-border
                                    flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span>Kembali</span>
                            </button>

                            <button onclick="nextStep()" class="flex-1 gradient-primary text-white px-8 py-4 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-xl">
                                <span>Tinjau Pesanan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Ringkasan -->
            <div id="step-3" class="step-content">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                    <div class="p-8 border-b border-gray-200">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Ringkasan Pesanan</h2>
                        </div>
                        <p class="text-gray-600">Periksa detail pesanan Anda sebelum melanjutkan</p>
                    </div>

                    <!-- Summary Content -->
                    <div class="p-8">
                        <div id="summaryContent">
                            <!-- Summary will be generated by JavaScript -->
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="mt-8 bg-white border-2 border-gray-200 rounded-2xl p-5">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" id="termsCheckbox" class="w-5 h-5 rounded text-purple-500 focus:ring-purple-500 border-gray-300 mt-0.5">
                                <span class="text-gray-700 text-sm">
                                    Saya menyetujui <a href="#" class="text-purple-500 font-semibold hover:text-purple-600 underline">Syarat dan Ketentuan</a>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="p-8 pt-0">
                        <div class="flex gap-4">
                            <button onclick="prevStep()"
                                class="flex-1 px-8 py-4 rounded-2xl font-bold text-lg
                                    text-purple-600 transition
                                    bg-white
                                    border-2 border-transparent
                                    bg-origin-border bg-clip-padding
                                    hover:bg-purple-100
                                    gradient-border
                                    flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span>Kembali</span>
                            </button>

                            <button onclick="completeOrder()" class="flex-1 gradient-primary text-white px-8 py-4 rounded-2xl font-bold text-base hover:bg-purple-600 transition shadow-xl">
                                <span>Selesaikan Pemesanan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div hidden id="id_form_hidden_that_you_need" class="class_form_hidden_that_you_need">
                <form action="/" method="POST" class="class_form" id="id_form">
                    @csrf
                    <!-- Kategori Alamat -->
                    <label for="id_kategori_alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Alamat
                    </label>
                    <input type="text" name="kategori_alamat" id="id_kategori_alamat"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">

                    <!-- Alamat Lengkap -->
                    <label for="id_alamat_lengkap" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Alamat Lengkap
                    </label>
                    <input type="text" name="alamat_lengkap" id="id_alamat_lengkap"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Instruksi Alamat -->
                    <label for="id_intruksi_alamat" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Instruksi Alamat (Opsional)
                    </label>
                    <input type="text" name="intruksi_alamat" id="id_intruksi_alamat"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Jenis Kontak -->
                    <label for="id_jenis_kontak" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Jenis Kontak
                    </label>
                    <input type="text" name="jenis_kontak" id="id_jenis_kontak"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Nama Depan -->
                    <label for="id_nama_depan" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Nama Depan
                    </label>
                    <input type="text" name="nama_depan" id="id_nama_depan"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Nama Belakang -->
                    <label for="id_nama_belakang" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Nama Belakang
                    </label>
                    <input type="text" name="nama_belakang" id="id_nama_belakang"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Jenis Kelamin -->
                    <label for="id_jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Jenis Kelamin
                    </label>
                    <input type="text" name="jenis_kelamin" id="id_jenis_kelamin"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Nomor Telepon -->
                    <label for="id_nomor_telepon" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Nomor Telepon
                    </label>
                    <input type="text" name="nomor_telepon" id="id_nomor_telepon"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">


                    <!-- Email -->
                    <label for="id_email" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Email
                    </label>
                    <input type="email" name="email" id="id_email"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">

                    <!-- Tanggal Pickup -->
                    <label for="id_picked_up_date" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Tanggal Pickup
                    </label>
                    <input type="date" name="picked_up_date" id="id_picked_up_date"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">

                    <!-- Waktu Pickup -->
                    <label for="id_picked_up_time" class="block text-sm font-semibold text-gray-700 mb-2 mt-6">
                        Waktu Pickup
                    </label>
                    <input type="time" name="picked_up_time" id="id_picked_up_time"
                        class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl
                            focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                </form>
            <div>
        </div>
    </section>

    <!-- Footer -->
    @include('landingPageComponent.footer')

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- JavaScript for Tab Buttons -->
<script>
    // Handle tab button clicks for address category
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            // Get parent container
            const parent = this.parentElement;

            // Remove active class from all buttons in this container
            parent.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Add active class to clicked button
            this.classList.add('active');
        });
    });

    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="/#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(2);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
<script>
document.getElementById('address').addEventListener('change', function () {
    const query = this.value;
    if (!query) return;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                alert('Alamat tidak ditemukan');
                return;
            }

            const lat = data[0].lat;
            const lon = data[0].lon;

            map.setView([lat, lon], 16);

            if (marker) map.removeLayer(marker);

            marker = L.marker([lat, lon]).addTo(map)
                .bindPopup(data[0].display_name)
                .openPopup();
        })
        .catch(err => console.error(err));
});
</script>
<script>
    const services = @json($dataLayanan);
</script>
<script>
    const BASE_STORAGE = "{{ asset('storage') }}";
    const BASE_IMAGE   = "{{ asset('images') }}";
</script>
<script>
        let currentStep = 1;
        let selectedServices = [];

        function getServiceImage(service) {
            if (service.foto && service.foto.trim() !== '') {
                return `${BASE_STORAGE}/${service.foto}`;
            }
            return `${BASE_IMAGE}/d_laundry_20251205_163940_0000.png`;
        }

        function getServiceImageClass(service) {
            // Kalau ADA foto asli penuh
            if (service.foto) {
                return 'w-full h-full object-cover';
            }

            // Kalau DEFAULT → kecil & contain
            return 'max-w-[80%] max-h-[80%] object-contain';
        }

        function initServices() {
            const grid = document.getElementById('serviceGrid');

            grid.innerHTML = services.map(service => `
                <div class="service-card bg-white rounded-2xl shadow-md border-2 border-gray-100"
                    onclick="toggleService('${service.id_layanan}', this)">

                    <div class="p-1.5">
                        <div class="w-full border-2 border-gray-200 rounded-2xl h-40 bg-white-50 overflow-hidden flex items-center justify-center">
                            <img
                                src="${getServiceImage(service)}"
                                alt="${service.nama_layanan}"
                                class="${getServiceImageClass(service)}"
                                loading="lazy"
                                onerror="this.onerror=null; this.src='/image/d_laundry_20251205_163940_0000.png';"
                            >
                        </div>
                    </div>

                    <div class="p-4">
                        <h4 class="font-bold text-gray-900 text-center text-sm">
                            ${service.nama_layanan}
                        </h4>

                        <p class="text-center text-purple-600 font-bold mt-2">
                            Rp ${Number(service.harga).toLocaleString('id-ID')}/${service.jenis === 'kiloan' ? 'Kg' : 'Pcs'}
                        </p>
                    </div>
                </div>
            `).join('');
        }

        document.addEventListener('DOMContentLoaded', initServices);

        function toggleService(id, card) {
            const service = services.find(s => s.id_layanan === id);
            if (!service) return;

            const exists = selectedServices.find(s => s.id_layanan === id);

            if (exists) {
                selectedServices = selectedServices.filter(s => s.id_layanan !== id);
                card.classList.remove('selected');
            } else {
                selectedServices.push({
                    id_layanan: service.id_layanan,
                    name: service.nama_layanan,
                    price: Number(service.harga),
                    quantity: 1
                });

                card.classList.add('selected');
            }

            console.log(selectedServices);
        }


        function updateProgressBar() {
            for (let i = 1; i <= 3; i++) {
                const step = document.getElementById(`progress-step-${i}`);
                const label = document.getElementById(`label-step-${i}`);

                if (i < currentStep) {
                    step.className = 'w-20 h-20 gradient-primary rounded-full flex items-center justify-center text-white font-bold shadow-lg transition-all';
                    step.innerHTML = '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>';
                    label.className = 'mt-3 font-semibold text-purple-600 text-sm';
                } else if (i === currentStep) {
                    step.className = 'w-20 h-20 gradient-primary rounded-full flex items-center justify-center text-white font-bold shadow-lg transition-all';
                    label.className = 'mt-3 font-semibold text-purple-600 text-sm';
                } else {
                    step.className = 'w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold transition-all';
                    label.className = 'mt-3 font-medium text-gray-400 text-sm';
                }
            }

            // Update connecting lines
            const line1 = document.getElementById('line-1');
            const line2 = document.getElementById('line-2');

            if (currentStep >= 2) {
                line1.className = 'w-60 md:w-80 h-1 bg-purple-600 rounded-full mx-4 transition-all';
            } else {
                line1.className = 'w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4 transition-all';
            }

            if (currentStep >= 3) {
                line2.className = 'w-60 md:w-80 h-1 bg-purple-600 rounded-full mx-4 transition-all';
            } else {
                line2.className = 'w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4 transition-all';
            }
        }

        function goToStep(step) {
            // Validate before allowing navigation
            if (step > currentStep) {
                if (currentStep === 1 && !validateStep1()) {
                    alert('Mohon lengkapi informasi pemesanan terlebih dahulu');
                    return;
                }
                if (currentStep === 2 && selectedServices.length === 0) {
                    alert('Mohon pilih minimal satu layanan');
                    return;
                }
            }

            currentStep = step;
            showStep(currentStep);
            updateProgressBar();
        }

        function showStep(step) {
            // Hide all steps
            for (let i = 1; i <= 3; i++) {
                const stepElement = document.getElementById(`step-${i}`);
                stepElement.classList.remove('active');
            }

            // Show current step with fade-in
            const currentStepElement = document.getElementById(`step-${step}`);
            currentStepElement.classList.add('active');

            // Scroll to top smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // If showing step 3, update summary
            if (step === 3) {
                updateSummary();
            }
        }

        function validateStep1() {
            const address = document.getElementById('address').value;
            const firstName = document.getElementById('firstName').value;
            const phone = document.getElementById('phone').value;
            const pickupDate = document.getElementById('pickupDate').value;
            const pickupTime = document.getElementById('pickupTime').value;

            return address && firstName && phone && pickupDate && pickupTime;
        }

        function nextStep() {
            if (currentStep === 1) {
                if (!validateStep1()) {
                    alert('Mohon lengkapi semua informasi yang diperlukan');
                    return;
                }
            }

            if (currentStep === 2) {
                if (selectedServices.length === 0) {
                    alert('Mohon pilih minimal satu layanan');
                    return;
                }
            }

            if (currentStep < 3) {
                currentStep++;
                showStep(currentStep);
                updateProgressBar();
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                updateProgressBar();
            }
        }

        function updateSummary() {
            const summaryContent = document.getElementById('summaryContent');

            if (selectedServices.length === 0) {
                summaryContent.innerHTML = `
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada layanan yang dipilih</p>
                    </div>
                `;
                return;
            }

            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const address = document.getElementById('address').value;
            const phone = document.getElementById('phone').value;
            const pickupDate = document.getElementById('pickupDate').value;
            const pickupTime = document.getElementById('pickupTime').value;

            const totalPrice = selectedServices.reduce((sum, s) => sum + (s.price * s.quantity), 0);
            const totalItems = selectedServices.reduce((sum, s) => sum + s.quantity, 0);

            summaryContent.innerHTML = `
                <!-- Customer Info -->
                <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Pelanggan</h3>
                    <div class="grid md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Nama</p>
                            <p class="font-semibold text-gray-900">${firstName} ${lastName}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Telepon</p>
                            <p class="font-semibold text-gray-900">+62 ${phone}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-600">Alamat Pickup</p>
                            <p class="font-semibold text-gray-900">${address}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Tanggal Pickup</p>
                            <p class="font-semibold text-gray-900">${pickupDate}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Waktu Pickup</p>
                            <p class="font-semibold text-gray-900">${pickupTime}</p>
                        </div>
                    </div>
                </div>

                <!-- Services Selected -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Layanan Terpilih</h3>
                    <div class="space-y-3">
                        ${selectedServices.map(service => `
                            <div class="bg-white border-2 border-gray-200 rounded-2xl p-4 flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900">${service.name}</h4>
                                    <p class="text-sm text-gray-600">Rp ${service.price.toLocaleString()} × ${service.quantity}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button onclick="decreaseQuantity(${service.id})" class="w-8 h-8 rounded-lg border-2 border-purple-500 text-purple-500 font-bold hover:bg-purple-50 transition flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center font-bold text-gray-900">${service.quantity}</span>
                                    <button onclick="increaseQuantity(${service.id})" class="w-8 h-8 rounded-lg gradient-primary text-white font-bold hover:bg-purple-600 transition flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <button onclick="removeService(${service.id})" class="w-8 h-8 rounded-lg border-2 border-red-500 text-red-500 hover:bg-red-50 transition flex items-center justify-center ml-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>

                <!-- Total -->
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 border-2 border-purple-200 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-700 font-semibold">Total Item</span>
                        <span class="text-gray-900 font-bold">${totalItems} layanan</span>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t-2 border-purple-200">
                        <span class="text-lg font-bold text-gray-900">Total Harga</span>
                        <span class="text-2xl font-bold text-purple-600">Rp ${totalPrice.toLocaleString()}</span>
                    </div>
                </div>
            `;
        }

        function increaseQuantity(serviceId) {
            const service = selectedServices.find(s => s.id_layanan === serviceId);
            if (service) {
                service.quantity++;
                updateSummary();
            }
        }

        function decreaseQuantity(serviceId) {
            const service = selectedServices.find(s => s.id_layanan === serviceId);
            if (service && service.quantity > 1) {
                service.quantity--;
                updateSummary();
            }
        }

        function removeService(serviceId) {
            if (confirm('Hapus layanan ini dari pesanan?')) {
                selectedServices = selectedServices.filter(s => s.id !== serviceId);
                updateSummary();

                // Update service card selection in step 2
                const cards = document.querySelectorAll('.service-card');
                cards.forEach(card => {
                    if (card.onclick.toString().includes(serviceId)) {
                        card.classList.remove('selected');
                    }
                });
            }
        }

        function completeOrder() {
            const termsChecked = document.getElementById('termsCheckbox').checked;

            if (!termsChecked) {
                alert('Mohon setujui Syarat dan Ketentuan terlebih dahulu');
                return;
            }

            if (selectedServices.length === 0) {
                alert('Keranjang Anda kosong. Silakan pilih layanan terlebih dahulu.');
                return;
            }

            // Success message
            alert('Pesanan berhasil dibuat! Anda akan dihubungi untuk konfirmasi.');

            // Reset and go back to home or confirmation page
            // window.location.href = '/';
        }

        // Handle tab button clicks for address category
        document.addEventListener('DOMContentLoaded', function() {
            initServices();
            updateProgressBar();

            // Tab buttons handler
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    const parent = this.parentElement;
                    parent.querySelectorAll('.tab-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });

            document.querySelectorAll('.service-card').forEach(card => {
                const id = card.getAttribute('onclick').match(/'(.*?)'/)[1];
                if (selectedServices.find(s => s.id_layanan === id)) {
                    card.classList.add('selected');
                }
            });

        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fallbackLat = -6.9175; // Bandung
        const fallbackLng = 107.6191;

        const map = L.map('map').setView([fallbackLat, fallbackLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([fallbackLat, fallbackLng]).addTo(map);

        // === GEOLOCATION USER ===
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    reverseGeocode(lat, lng);
                },
                function () {
                    // user nolak lokasi → pakai fallback
                    reverseGeocode(fallbackLat, fallbackLng);
                }
            );
        }

        // Klik map → update lokasi
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;

            marker.setLatLng([lat, lng]);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            reverseGeocode(lat, lng);
        });

        // Reverse geocoding OSM
        function reverseGeocode(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {
                    if (data.display_name) {
                        document.getElementById('address').value = data.display_name;
                    }
                });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const addressInput = document.getElementById('address');
        if (!addressInput) return;

        addressInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                const query = addressInput.value.trim();
                if (!query) return;

                forwardGeocode(query);
            }
        });

        function forwardGeocode(address) {
            fetch(`/geocode?q=${encodeURIComponent(address)}`)
            .then(res => res.json())
            .then(data => {
                if (!data || data.length === 0) {
                    alert('Alamat tidak ditemukan');
                    return;
                }

                const lat = parseFloat(data[0].lat);
                const lng = parseFloat(data[0].lon);

                map.setView([lat, lng], 16);

                if (!window.marker) {
                    window.marker = L.marker([lat, lng]).addTo(map);
                } else {
                    window.marker.setLatLng([lat, lng]);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Gagal mencari alamat');
            });
        }
    });
</script>

<script>
    function DirectToLoginView(){
        window.location.href = '/customer-login';
    }

    function ChooseYourTypeOfContect(type_of_contect){
        if(type_of_contect === 'Perusahaan'){
            document.getElementById('idHiddenPerusahaan').hidden = false;
            document.getElementById('id_namaPerusahaan').value = "";
        } else {
            document.getElementById('idHiddenPerusahaan').hidden = true;
            document.getElementById('id_namaPerusahaan').value = "";
        }
    }
</script>
<script>
// Fungsi untuk update cart counter
function updateCartCounter() {
    const cartCount = selectedServices.reduce((sum, s) => sum + s.quantity, 0);
    
    // Simpan ke localStorage agar persisten
    localStorage.setItem('cartCount', cartCount);
    localStorage.setItem('cartItems', JSON.stringify(selectedServices));
    
    // Update counter di navbar (akan dibaca oleh navbar)
    const event = new CustomEvent('cartUpdated', { 
        detail: { count: cartCount } 
    });
    window.dispatchEvent(event);
}

// Modifikasi fungsi toggleService yang sudah ada
function toggleService(id, card) {
    const service = services.find(s => s.id_layanan === id);
    if (!service) return;

    const exists = selectedServices.find(s => s.id_layanan === id);

    if (exists) {
        selectedServices = selectedServices.filter(s => s.id_layanan !== id);
        card.classList.remove('selected');
    } else {
        selectedServices.push({
            id_layanan: service.id_layanan,
            name: service.nama_layanan,
            price: Number(service.harga),
            quantity: 1
        });
        card.classList.add('selected');
    }

    // Update cart counter
    updateCartCounter();
    console.log(selectedServices);
}

// Modifikasi fungsi increaseQuantity
function increaseQuantity(serviceId) {
    const service = selectedServices.find(s => s.id_layanan === serviceId);
    if (service) {
        service.quantity++;
        updateSummary();
        updateCartCounter(); // Tambahkan ini
    }
}

// Modifikasi fungsi decreaseQuantity
function decreaseQuantity(serviceId) {
    const service = selectedServices.find(s => s.id_layanan === serviceId);
    if (service && service.quantity > 1) {
        service.quantity--;
        updateSummary();
        updateCartCounter(); // Tambahkan ini
    }
}

// Modifikasi fungsi removeService
function removeService(serviceId) {
    if (confirm('Hapus layanan ini dari pesanan?')) {
        selectedServices = selectedServices.filter(s => s.id_layanan !== serviceId);
        updateSummary();
        updateCartCounter(); // Tambahkan ini

        // Update service card selection in step 2
        const cards = document.querySelectorAll('.service-card');
        cards.forEach(card => {
            if (card.onclick.toString().includes(serviceId)) {
                card.classList.remove('selected');
            }
        });
    }
}

// Load cart saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const savedCart = localStorage.getItem('cartItems');
    if (savedCart) {
        selectedServices = JSON.parse(savedCart);
        updateCartCounter();
    }
});
</script>
</body>
</html>
