<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan - D'Laundry</title>
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

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .service-item {
            transition: all 0.3s ease;
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
                        <span class="mt-3 font-semibold text-green-600 text-sm">Informasi Pemesanan</span>
                    </div>

                    <!-- Line Connector 1 -->
                    <div class="w-60 md:w-80 h-1 bg-green-500 rounded-full mx-4"></div>

                    <!-- Step 2: Layanan -->
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="mt-3 font-semibold text-green-600 text-sm">Layanan</span>
                    </div>

                    <!-- Line Connector 2 -->
                    <div class="w-60 md:w-80 h-1 bg-gradient-to-r from-green-500 to-orange-500 rounded-full mx-4"></div>

                    <!-- Step 3: Ringkasan -->
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="mt-3 font-semibold text-orange-500 text-sm">Ringkasan</span>
                    </div>
                </div>
            </div>

            <!-- Summary Content -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 fade-in">
                <!-- Header -->
                <div class="p-8 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Ringkasan</h2>
                    </div>
                    <p class="text-gray-600">Periksa detail pesanan Anda sebelum melakukan pembayaran</p>
                </div>

                <!-- Selected Services Section -->
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Layanan Terpilih</h3>
                    </div>

                    <!-- Service Items List -->
                    <div class="space-y-4" id="serviceList">
                        <!-- Service Item 1 -->
                        <div class="service-item bg-white border-2 border-gray-200 rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-gray-900 text-base">Laundry Helm</h4>
                                <div class="flex items-center gap-3">
                                    <button class="w-9 h-9 rounded-lg border-2 border-orange-500 text-orange-500 font-bold hover:bg-orange-50 transition flex items-center justify-center" onclick="decreaseQuantity(1)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center font-bold text-gray-900" id="quantity-1">1</span>
                                    <button class="w-9 h-9 rounded-lg bg-orange-500 text-white font-bold hover:bg-orange-600 transition flex items-center justify-center" onclick="increaseQuantity(1)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <button class="w-9 h-9 rounded-lg border-2 border-red-500 text-red-500 hover:bg-red-50 transition flex items-center justify-center ml-2" onclick="removeItem(1)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Service Item 2 -->
                        <div class="service-item bg-white border-2 border-gray-200 rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-gray-900 text-base">Laundry Express</h4>
                                <div class="flex items-center gap-3">
                                    <button class="w-9 h-9 rounded-lg border-2 border-orange-500 text-orange-500 font-bold hover:bg-orange-50 transition flex items-center justify-center" onclick="decreaseQuantity(2)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center font-bold text-gray-900" id="quantity-2">1</span>
                                    <button class="w-9 h-9 rounded-lg bg-orange-500 text-white font-bold hover:bg-orange-600 transition flex items-center justify-center" onclick="increaseQuantity(2)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <button class="w-9 h-9 rounded-lg border-2 border-red-500 text-red-500 hover:bg-red-50 transition flex items-center justify-center ml-2" onclick="removeItem(2)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Add-On Services -->
                            <div class="ml-4 mt-3 pl-4 border-l-2 border-gray-200">
                                <p class="text-sm text-gray-600 mb-2 font-semibold">Add-On Services:</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="add-on-badge">Noda Karat</span>
                                </div>
                            </div>
                        </div>

                        <!-- Service Item 3 -->
                        <div class="service-item bg-white border-2 border-gray-200 rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-gray-900 text-base">Reparasi Tas</h4>
                                <div class="flex items-center gap-3">
                                    <button class="w-9 h-9 rounded-lg border-2 border-orange-500 text-orange-500 font-bold hover:bg-orange-50 transition flex items-center justify-center" onclick="decreaseQuantity(3)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="w-8 text-center font-bold text-gray-900" id="quantity-3">1</span>
                                    <button class="w-9 h-9 rounded-lg bg-orange-500 text-white font-bold hover:bg-orange-600 transition flex items-center justify-center" onclick="increaseQuantity(3)">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <button class="w-9 h-9 rounded-lg border-2 border-red-500 text-red-500 hover:bg-red-50 transition flex items-center justify-center ml-2" onclick="removeItem(3)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Add-On Services -->
                            <div class="ml-4 mt-3 pl-4 border-l-2 border-gray-200">
                                <p class="text-sm text-gray-600 mb-2 font-semibold">Add-On Services:</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="add-on-badge">Noda Tinta</span>
                                </div>
                            </div>
                            <!-- Catatan -->
                            <div class="ml-4 mt-3 pl-4 border-l-2 border-gray-200">
                                <p class="text-sm text-gray-600 mb-1 font-semibold">Catatan:</p>
                                <p class="text-sm text-gray-700">Hati-hati tas mahal</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Layanan -->
                    <div class="mt-6 flex items-center justify-between py-4 border-t-2 border-gray-200">
                        <span class="font-bold text-gray-900 text-lg">Total Layanan Dipilih</span>
                        <span class="font-bold text-orange-500 text-lg" id="totalItems">4 layanan</span>
                    </div>

                    <!-- Add Item Button -->
                    <div class="mt-6">
                        <button class="w-full border-2 border-dashed border-orange-300 text-orange-500 px-6 py-4 rounded-2xl font-semibold hover:bg-orange-50 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Tambah Item</span>
                        </button>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="mt-8 bg-white border-2 border-gray-200 rounded-2xl p-5">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 rounded text-orange-500 focus:ring-orange-500 border-gray-300 mt-0.5" id="termsCheckbox">
                            <span class="text-gray-700 text-sm">
                                Saya menyetujui 
                                <a href="#" class="text-orange-500 font-semibold hover:text-orange-600 underline">Syarat dan Ketentuan</a>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-8 pt-0">
                    <div class="flex gap-4">
                        <button class="flex-1 border-2 border-orange-500 text-orange-500 px-8 py-4 rounded-2xl font-bold text-base hover:bg-orange-50 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span>Kembali</span>
                        </button>
                        <button class="flex-1 bg-orange-500 text-white px-8 py-4 rounded-2xl font-bold text-base hover:bg-orange-600 transition shadow-xl" id="checkoutButton">
                            <span>Selesaikan Pemesanan</span>
                        </button>
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
        let items = [
            { id: 1, name: 'Laundry Helm', quantity: 1, addOns: [], note: '' },
            { id: 2, name: 'Laundry Express', quantity: 1, addOns: ['Noda Karat'], note: '' },
            { id: 3, name: 'Reparasi Tas', quantity: 1, addOns: ['Noda Tinta'], note: 'Hati-hati tas mahal' }
        ];

        function increaseQuantity(itemId) {
            const item = items.find(i => i.id === itemId);
            if (item) {
                item.quantity++;
                updateUI();
            }
        }

        function decreaseQuantity(itemId) {
            const item = items.find(i => i.id === itemId);
            if (item && item.quantity > 1) {
                item.quantity--;
                updateUI();
            }
        }

        function removeItem(itemId) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                items = items.filter(i => i.id !== itemId);
                updateUI();
                
                if (items.length === 0) {
                    location.reload();
                }
            }
        }

        function updateUI() {
            // Update quantity display
            items.forEach(item => {
                const quantityEl = document.getElementById(`quantity-${item.id}`);
                if (quantityEl) {
                    quantityEl.textContent = item.quantity;
                }
            });

            // Update total items
            const totalItems = items.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('totalItems').textContent = `${totalItems} layanan`;
        }

        // Checkout button handler
        document.getElementById('checkoutButton').addEventListener('click', function() {
            const termsChecked = document.getElementById('termsCheckbox').checked;
            
            if (!termsChecked) {
                alert('Mohon setujui Syarat dan Ketentuan terlebih dahulu');
                return;
            }

            if (items.length === 0) {
                alert('Keranjang Anda kosong. Silakan tambah layanan terlebih dahulu.');
                return;
            }

            // Proceed to checkout
            alert('Mengarahkan ke halaman pembayaran...');
            // window.location.href = '/checkout';
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

        // Initialize
        updateUI();
    </script>

</body>
</html>