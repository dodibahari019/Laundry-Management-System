<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - D'Laundry</title>
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
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .badge-promo {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
        }

        .badge-bestseller {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
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
        <div class="max-w-8xl mx-auto px-5 sm:px-7 lg:px-7">
            <!-- Progress Indicator -->
            <div class="mb-12 fade-in">
                <div class="flex items-center justify-center">
                    <!-- Step 1: Informasi Pemesanan -->
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="mt-3 font-semibold text-green-600 text-sm">Info Pemesanan</span>
                    </div>

                    <!-- Line Connector 1 -->
                    <div class="w-60 md:w-80 h-1 bg-gradient-to-r from-green-500 to-orange-500 rounded-full mx-4"></div>

                    <!-- Step 2: Layanan -->
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="mt-3 font-semibold text-orange-500 text-sm">Layanan</span>
                    </div>

                    <!-- Line Connector 2 -->
                    <div class="w-60 md:w-80 h-1 bg-gray-300 rounded-full mx-4"></div>

                    <!-- Step 3: Ringkasan -->
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="mt-3 font-medium text-gray-400 text-sm">Ringkasan</span>
                    </div>
                </div>
            </div>

            <!-- Service Selection -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                <!-- Header -->
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Pilih Layanan</h2>
                    </div>
                    <p class="text-gray-600 ml-13">Pilih jenis layanan dan jumlah yang Anda butuhkan</p>
                </div>

                <!-- Category Tabs -->
                <div class="p-8 pb-4">
                    <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide">
                        <button class="tab-button active px-6 py-3 rounded-full font-semibold border-2 border-gray-200 whitespace-nowrap" data-category="all">
                            Semua Layanan
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="shoe">
                            Shoe Care
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="bag">
                            Bag Spa
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="daily">
                            Daily
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="household">
                            Household
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="lifestyle">
                            Lifestyle
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="little">
                            Little Ones Care
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="treatment">
                            Treatment
                        </button>
                        <button class="tab-button px-6 py-3 rounded-full font-semibold border-2 border-gray-200 bg-white text-gray-700 whitespace-nowrap" data-category="stain">
                            Stain
                        </button>
                    </div>
                </div>

                <!-- Service Grid -->
                <div class="p-8 pt-4">
                    <h3 class="text-3xl font-bold text-gray-900 mb-2 text-center">Semua Layanan</h3>
                    <p class="text-gray-600 text-center mb-8">Klik layanan untuk memilih varian</p>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6" id="serviceGrid">
                        <!-- Service Card 1 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="jaket-suede">
                            <span class="badge-promo bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">PROMO</span>
                            <img src="https://via.placeholder.com/300x300/2d2d2d/ffffff?text=Jaket+Suede" alt="Laundry Jaket Suede" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Laundry Jaket Suede</h4>
                            </div>
                        </div>

                        <!-- Service Card 2 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="koin">
                            <span class="badge-bestseller bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">BEST SELLER</span>
                            <img src="https://via.placeholder.com/300x300/f5f5f5/666666?text=Laundry+Koin" alt="Laundry Koin" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Laundry Koin</h4>
                            </div>
                        </div>

                        <!-- Service Card 3 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="express">
                            <span class="badge-bestseller bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">BEST SELLER</span>
                            <img src="https://via.placeholder.com/300x300/4a90e2/ffffff?text=Laundry+Express" alt="Laundry Express" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Laundry Express</h4>
                            </div>
                        </div>

                        <!-- Service Card 4 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="noda-tinta">
                            <span class="badge-bestseller bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">BEST SELLER</span>
                            <img src="https://via.placeholder.com/300x300/e8d7c3/666666?text=Noda+Tinta" alt="Noda Tinta" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Noda Tinta</h4>
                            </div>
                        </div>

                        <!-- Service Card 5 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="sepatu">
                            <img src="https://via.placeholder.com/300x300/87ceeb/ffffff?text=Reparasi+Sepatu" alt="Reparasi Sepatu" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Reparasi Sepatu</h4>
                            </div>
                        </div>

                        <!-- Service Card 6 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="noda-karat">
                            <span class="badge-bestseller bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">BEST SELLER</span>
                            <img src="https://via.placeholder.com/300x300/fff8dc/666666?text=Noda+Karat" alt="Noda Karat" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Noda Karat</h4>
                            </div>
                        </div>

                        <!-- Service Card 7 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="jaket-kulit">
                            <span class="badge-promo bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">PROMO</span>
                            <img src="https://via.placeholder.com/300x300/2d2d2d/ffffff?text=Jaket+Kulit" alt="Laundry Jaket Kulit" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Laundry Jaket Kulit</h4>
                            </div>
                        </div>

                        <!-- Service Card 8 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="tas">
                            <img src="https://via.placeholder.com/300x300/8b4513/ffffff?text=Reparasi+Tas" alt="Reparasi Tas" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Reparasi Tas</h4>
                            </div>
                        </div>

                        <!-- Service Card 9 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="noda-luntur">
                            <span class="badge-bestseller bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">BEST SELLER</span>
                            <img src="https://via.placeholder.com/300x300/f0f0f0/666666?text=Noda+Luntur" alt="Noda Luntur" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Noda Luntur</h4>
                            </div>
                        </div>

                        <!-- Service Card 10 -->
                        <div class="service-card bg-white rounded-2xl shadow-md overflow-hidden border-2 border-gray-100 relative" data-service="handuk">
                            <span class="badge-promo bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">HOUSEHOLD</span>
                            <img src="https://via.placeholder.com/300x300/ffb6c1/ffffff?text=Laundry+Handuk" alt="Laundry Handuk" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-center">Laundry Handuk</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="p-8 pt-4">
                    <button class="w-full border-2 border-orange-500 text-orange-500 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-orange-50 transition flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span>Kembali</span>
                    </button>
                </div>
            </div>

            <!-- Selected Services Summary (Fixed Bottom) -->
            <div class="fixed bottom-0 left-0 right-0 bg-white border-t-4 border-orange-500 shadow-2xl p-6 z-40">
                <div class="max-w-8xl mx-auto px-5 flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="font-bold text-gray-900">Layanan Terpilih</span>
                        </div>
                        <p class="text-sm text-gray-600">Total Layanan Dipilih: <span class="font-bold text-orange-500" id="totalServices">0 layanan</span></p>
                    </div>
                    <button class="gradient-primary text-white px-10 py-4 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-xl flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Tinjau Pesanan</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16 mb-24">
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

    <!-- JavaScript -->
    <script>
        let selectedServices = [];

        // Handle tab button clicks
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Handle service card selection
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', function() {
                const serviceId = this.dataset.service;
                
                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    selectedServices = selectedServices.filter(s => s !== serviceId);
                } else {
                    this.classList.add('selected');
                    selectedServices.push(serviceId);
                }
                
                updateServiceCount();
            });
        });

        function updateServiceCount() {
            const count = selectedServices.length;
            document.getElementById('totalServices').textContent = `${count} layanan`;
        }

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
</html>