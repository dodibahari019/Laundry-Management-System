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

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .service-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .service-card.selected {
            border: 3px solid #667eea;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .add-on-badge {
            background: #f5f5f5;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #666;
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
                    <a href="/customer-orders" class="text-gray-700 hover:text-purple-600 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-6 h-6">
                            <path d="M3 3h2l2.5 12h10l2-8H6.5" />
                            <circle cx="9" cy="20" r="1" />
                            <circle cx="17" cy="20" r="1" />
                        </svg>3
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
        <div class="max-w-8xl mx-auto px-5 sm:px-7 lg:px-7">
            <!-- Progress Indicator -->
            <div class="mb-12 fade-in">
                <div class="flex items-center justify-center">
                    <!-- Step 1: Informasi Pemesanan -->
                    <div class="flex flex-col items-center cursor-pointer" onclick="goToStep(1)">
                        <div id="progress-step-1" class="w-20 h-20 gradient-primary rounded-full flex items-center justify-center text-white font-bold shadow-lg transition-all">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <span id="label-step-1" class="mt-3 font-semibold text-purple-600 text-sm">Info Pemesanan</span>
                    </div>

                    <!-- Line Connector 1 -->
                    <div id="line-1" class="w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4 transition-all"></div>

                    <!-- Step 2: Layanan -->
                    <div class="flex flex-col items-center cursor-pointer" onclick="goToStep(2)">
                        <div id="progress-step-2" class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold transition-all">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span id="label-step-2" class="mt-3 font-medium text-gray-400 text-sm">Layanan</span>
                    </div>

                    <!-- Line Connector 2 -->
                    <div id="line-2" class="w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4 transition-all"></div>

                    <!-- Step 3: Ringkasan -->
                    <div class="flex flex-col items-center cursor-pointer" onclick="goToStep(3)">
                        <div id="progress-step-3" class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold transition-all">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span id="label-step-3" class="mt-3 font-medium text-gray-400 text-sm">Ringkasan</span>
                    </div>
                </div>
            </div>

            <!-- Step 1: Informasi Pemesanan -->
            <div id="step-1" class="step-content active fade-in">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100">
                    <!-- Alamat Pickup -->
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
                                    <button class="tab-button active px-6 py-3 rounded-xl font-semibold border-2 border-gray-200">Rumah</button>
                                    <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700">Kost</button>
                                    <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700">Kantor</button>
                                    <button class="tab-button px-6 py-3 rounded-xl font-semibold border-2 border-gray-200 bg-white text-gray-700">Hotel</button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                                <input type="text" id="address" placeholder="Masukkan alamat lengkap" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Instruksi Alamat (Opsional)</label>
                                <textarea placeholder="Contoh: Rumah cat hijau, dekat warung Pak Budi" rows="3" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
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
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Depan</label>
                                    <input type="text" id="firstName" placeholder="Nama depan" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Belakang</label>
                                    <input type="text" id="lastName" placeholder="Nama belakang" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                    <div class="flex gap-2">
                                        <div class="w-20 px-4 py-4 border-2 border-gray-200 rounded-2xl bg-gray-50 flex items-center justify-center font-semibold text-gray-700">+62</div>
                                        <input type="tel" id="phone" placeholder="812-3456-7890" class="flex-1 px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" id="email" placeholder="email@example.com" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Pickup -->
                    <div class="p-8 border-b border-gray-200">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Jadwal Pickup</h2>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                                <input type="date" id="pickupDate" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu</label>
                                <select id="pickupTime" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                                    <option value="">Pilih slot waktu</option>
                                    <option value="09:00-11:00">09:00 - 11:00</option>
                                    <option value="11:00-13:00">11:00 - 13:00</option>
                                    <option value="13:00-15:00">13:00 - 15:00</option>
                                    <option value="15:00-17:00">15:00 - 17:00</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="p-8">
                        <button onclick="nextStep()" class="w-full gradient-primary text-white px-8 py-5 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-xl flex items-center justify-center gap-3">
                            <span>Lanjut ke Layanan</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Layanan -->
            <div id="step-2" class="step-content">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                    <div class="p-8 border-b border-gray-200">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
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
                            <button onclick="prevStep()" class="flex-1 border-2 border-orange-500 text-orange-500 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-orange-50 transition flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
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
                            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
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
                                <input type="checkbox" id="termsCheckbox" class="w-5 h-5 rounded text-orange-500 focus:ring-orange-500 border-gray-300 mt-0.5">
                                <span class="text-gray-700 text-sm">
                                    Saya menyetujui <a href="#" class="text-orange-500 font-semibold hover:text-orange-600 underline">Syarat dan Ketentuan</a>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="p-8 pt-0">
                        <div class="flex gap-4">
                            <button onclick="prevStep()" class="flex-1 border-2 border-orange-500 text-orange-500 px-8 py-4 rounded-2xl font-bold text-base hover:bg-orange-50 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span>Kembali</span>
                            </button>
                            <button onclick="completeOrder()" class="flex-1 bg-orange-500 text-white px-8 py-4 rounded-2xl font-bold text-base hover:bg-orange-600 transition shadow-xl">
                                <span>Selesaikan Pemesanan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="image/LogoDLaundry.png" alt="D'Laundry" class="h-12 w-auto opacity-80">
                        <span class="text-2xl font-bold text-white">D'Laundry</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">Sistem manajemen laundry modern yang memudahkan hidup Anda.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        let currentStep = 1;
        let selectedServices = [];
        
        const services = [
            { id: 1, name: 'Laundry Jaket Suede', category: 'treatment', price: 50000 },
            { id: 2, name: 'Laundry Koin', category: 'daily', price: 25000 },
            { id: 3, name: 'Laundry Express', category: 'daily', price: 35000 },
            { id: 4, name: 'Noda Tinta', category: 'stain', price: 15000 },
            { id: 5, name: 'Reparasi Sepatu', category: 'shoe', price: 40000 },
            { id: 6, name: 'Noda Karat', category: 'stain', price: 15000 },
            { id: 7, name: 'Laundry Jaket Kulit', category: 'treatment', price: 60000 },
            { id: 8, name: 'Reparasi Tas', category: 'bag', price: 45000 },
            { id: 9, name: 'Noda Luntur', category: 'stain', price: 15000 },
            { id: 10, name: 'Laundry Handuk', category: 'household', price: 20000 }
        ];

        function initServices() {
            const grid = document.getElementById('serviceGrid');
            grid.innerHTML = services.map(service => `
                <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" onclick="toggleService(${service.id})">
                    <div class="w-full h-48 bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                        <span class="text-4xl">🧺</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-900 text-center text-sm">${service.name}</h4>
                        <p class="text-center text-purple-600 font-bold mt-2">Rp ${service.price.toLocaleString()}</p>
                    </div>
                </div>
            `).join('');
        }

        function toggleService(id) {
            const card = event.currentTarget;
            const service = services.find(s => s.id === id);
            
            if (selectedServices.find(s => s.id === id)) {
                selectedServices = selectedServices.filter(s => s.id !== id);
                card.classList.remove('selected');
            } else {
                selectedServices.push({...service, quantity: 1});
                card.classList.add('selected');
            }
        }

        function updateProgressBar() {
            for (let i = 1; i <= 3; i++) {
                const step = document.getElementById(`progress-step-${i}`);
                const label = document.getElementById(`label-step-${i}`);
                
                if (i < currentStep) {
                    step.className = 'w-20 h-20 bg-green-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg transition-all';
                    step.innerHTML = '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>';
                    label.className = 'mt-3 font-semibold text-green-600 text-sm';
                } else if (i === currentStep) {
                    step.className = 'w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg transition-all';
                    label.className = 'mt-3 font-semibold text-orange-500 text-sm';
                } else {
                    step.className = 'w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold transition-all';
                    label.className = 'mt-3 font-medium text-gray-400 text-sm';
                }
            }

            // Update connecting lines
            const line1 = document.getElementById('line-1');
            const line2 = document.getElementById('line-2');

            if (currentStep >= 2) {
                line1.className = 'w-60 md:w-80 h-1 bg-green-500 rounded-full mx-4 transition-all';
            } else {
                line1.className = 'w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4 transition-all';
            }

            if (currentStep >= 3) {
                line2.className = 'w-60 md:w-80 h-1 bg-green-500 rounded-full mx-4 transition-all';
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
                                    <button onclick="decreaseQuantity(${service.id})" class="w-8 h-8 rounded-lg border-2 border-orange-500 text-orange-500 font-bold hover:bg-orange-50 transition flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center font-bold text-gray-900">${service.quantity}</span>
                                    <button onclick="increaseQuantity(${service.id})" class="w-8 h-8 rounded-lg bg-orange-500 text-white font-bold hover:bg-orange-600 transition flex items-center justify-center">
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
            const service = selectedServices.find(s => s.id === serviceId);
            if (service) {
                service.quantity++;
                updateSummary();
            }
        }

        function decreaseQuantity(serviceId) {
            const service = selectedServices.find(s => s.id === serviceId);
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
        });
    </script>

</body>
</html>