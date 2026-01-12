<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - D'Laundry</title>
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
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

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
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
                    <img src="image/LogoDLaundry.png" alt="D'Laundry" class="h-12 w-auto opacity-80">
                    <a href="/">
                        <span class="text-2xl font-bold text-gray-900">D'Laundry</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-10">
                    <a href="/#layanan" class="text-gray-700 hover:text-purple-600 font-medium transition">Layanan</a>
                    <a href="/#harga" class="text-gray-700 hover:text-purple-600 font-medium transition">Harga</a>
                    <a href="/#tracking" class="text-gray-700 hover:text-purple-600 font-medium transition">Tracking</a>
                    <a href="/#keunggulan" class="text-gray-700 hover:text-purple-600 font-medium transition">Keunggulan</a>
                    <a href="/#testimoni" class="text-gray-700 hover:text-purple-600 font-medium transition">Testimoni</a>
                    <a href="/customer/orders"
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
                            <path d="M3 3h2l2.5 12h10l2-8H6.5" />
                            <circle cx="9" cy="20" r="1" />
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

    <!-- Main Content -->
    <section class="pt-32 pb-24 bg-gray-50 min-h-screen">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Progress Indicator -->
            <div class="mb-12 fade-in">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-semibold text-purple-600">Informasi Pemesanan</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-gray-400">Layanan</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-gray-400">Ringkasan</span>
                    </div>
                </div>
            </div>

            <!-- Order Form -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
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
                                <input type="text" 
                                    placeholder="majalengka" 
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-base"
                                >
                                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-100 rounded-2xl overflow-hidden" style="height: 300px;">
                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                <div class="text-center">
                                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <p class="font-medium">Peta akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div>

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
                                <button class="tab-button active px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Individu
                                </button>
                                <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Perusahaan
                                </button>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Depan</label>
                                <input type="text" 
                                    placeholder="Nama depan Anda"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Belakang</label>
                                <input type="text" 
                                    placeholder="Nama belakang Anda"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                            <div class="flex gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="laki-laki" class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                    <span class="font-medium text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="perempuan" class="w-5 h-5 text-purple-600 focus:ring-purple-500">
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
                                        placeholder="Masukkan nomor telepon"
                                        class="flex-1 px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" 
                                    placeholder="email@example.com"
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
                                    <input type="checkbox" class="w-5 h-5 rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                                    <span class="font-semibold text-gray-900">Ya, dengan buat akun Getwash Laundry, kamu menyetujui Syarat dan Ketentuan & Kebijakan Privasi</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-lg font-semibold text-gray-900">Sudah punya akun?</p>
                            <button class="text-purple-600 font-bold hover:text-purple-700 transition">
                                Login Sekarang
                            </button>
                        </div>
                    </div>
                </div>

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
                                <input type="text" 
                                    value="January 13th, 2026"
                                    readonly
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl bg-white focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition cursor-pointer"
                                >
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jam berapa?</label>
                            <select class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition appearance-none bg-white cursor-pointer">
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
                    <button class="w-full gradient-primary text-white px-8 py-5 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-xl flex items-center justify-center gap-3">
                        <span>Lanjut ke Layanan</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
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
                        <img src="image/LogoDLaundry.png" alt="D'Laundry" class="h-12 w-auto opacity-80">
                        <span class="text-2xl font-bold text-white">D'Laundry</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Sistem manajemen laundry modern yang memudahkan hidup Anda.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-4">Layanan</h4>
                    <ul class="space-y-3">
                        <li><a href="/#layanan" class="hover:text-purple-400 transition">Cuci Kiloan</a></li>
                        <li><a href="/#layanan" class="hover:text-purple-400 transition">Cuci Express</a></li>
                        <li><a href="/#layanan" class="hover:text-purple-400 transition">Cuci Satuan</a></li>
                        <li><a href="/#layanan" class="hover:text-purple-400 transition">Cuci Premium</a></li>
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

</body>
</html