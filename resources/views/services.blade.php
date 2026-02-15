<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D`Laundry - Katalog Layanan</title>
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .service-card {
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .service-card.selected {
            border-color: #7c3aed !important;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25) !important;
            transform: translateY(-4px) !important;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.15);
        }

        .filter-button {
            transition: all 0.3s ease;
        }

        .filter-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .search-input {
            padding-left: 60px;
        }

        /* Quantity Controls */
        .quantity-controls {
            display: none;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #e5e7eb;
        }

        .service-card.selected .quantity-controls {
            display: flex;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            transform: scale(1.1);
        }

        .qty-btn.minus {
            border: 2px solid #7c3aed;
            color: #7c3aed;
            background: white;
        }

        .qty-btn.minus:hover {
            background: #f3e8ff;
        }

        .qty-btn.plus {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .qty-btn.plus:hover {
            opacity: 0.9;
        }

        .qty-btn.delete {
            border: 2px solid #ef4444;
            color: #ef4444;
            background: white;
        }

        .qty-btn.delete:hover {
            background: #fee2e2;
        }

        .qty-display {
            min-width: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: #1f2937;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('landingPageComponent.navbar')

    <!-- Hero Section -->
    <section class="pt-32 pb-24 gradient-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center text-white fade-in">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                    Katalog Lengkap<br/>
                    <span class="text-yellow-300">Layanan Kami</span>
                </h1>
                <p class="text-xl mb-10 text-purple-100 leading-relaxed max-w-3xl mx-auto">
                    Pilih layanan favorit Anda dan tambahkan ke keranjang dengan mudah
                </p>
            </div>
        </div>

        <!-- Wave Bottom (Lebih Tinggi) -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 106C120 92 240 64 360 48C480 32 600 28 720 36C840 44 960 64 1080 72C1200 80 1320 76 1380 74L1440 72V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-8 fade-in">
                <div class="search-container max-w-3xl mx-auto">
                    <svg class="search-icon w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari layanan (contoh: cuci, setrika, kiloan...)"
                        class="search-input w-full pl-13 pr-6 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-lg shadow-lg"
                    >
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button onclick="filterServices('semua')" class="filter-button active px-8 py-4 rounded-2xl font-bold border-2 border-gray-200 bg-white text-gray-700">
                    Semua Layanan
                </button>
                <button onclick="filterServices('kiloan')" class="filter-button px-8 py-4 rounded-2xl font-bold border-2 border-gray-200 bg-white text-gray-700">
                    Cuci Kiloan
                </button>
                <button onclick="filterServices('satuan')" class="filter-button px-8 py-4 rounded-2xl font-bold border-2 border-gray-200 bg-white text-gray-700">
                    Cuci Satuan
                </button>
            </div>

            <!-- Services Grid -->
            <div id="servicesGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
                <!-- Service cards will be generated by JavaScript -->
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-400 mb-2">Layanan Tidak Ditemukan</h3>
                <p class="text-gray-500">Coba gunakan kata kunci lain atau filter yang berbeda</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('landingPageComponent.footer')

    <script>
        // Data dari backend
        const servicesData = @json($allLayanan ?? []);
        const BASE_STORAGE = "{{ asset('storage') }}";
        const BASE_IMAGE = "{{ asset('image') }}";
        
        let selectedServices = [];
        let currentFilter = 'semua';

        // Helper Functions
        function getServiceImage(service) {
            if (service.foto && service.foto.trim() !== '') {
                return `${BASE_STORAGE}/${service.foto}`;
            }
            return `${BASE_IMAGE}/d_laundry_20251205_163940_0000.png`;
        }

        function getServiceImageClass(service) {
            if (service.foto) {
                return 'w-full h-full object-cover';
            }
            return 'max-w-[80%] max-h-[80%] object-contain';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadCartFromStorage();
            renderServices(servicesData);

            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const filtered = servicesData.filter(service =>
                    service.nama_layanan.toLowerCase().includes(searchTerm) ||
                    service.jenis.toLowerCase().includes(searchTerm)
                );

                if (currentFilter !== 'semua') {
                    const doubleFiltered = filtered.filter(s => s.jenis === currentFilter);
                    renderServices(doubleFiltered);
                } else {
                    renderServices(filtered);
                }
            });
        });

        // Load cart from localStorage
        function loadCartFromStorage() {
            const savedCart = localStorage.getItem('cartItems');
            if (savedCart) {
                const cartItems = JSON.parse(savedCart);
                selectedServices = cartItems.map(item => ({
                    id_layanan: item.id_layanan,
                    nama_layanan: item.name,
                    jenis: servicesData.find(s => s.id_layanan === item.id_layanan)?.jenis || 'kiloan',
                    harga: item.price,
                    quantity: item.quantity,
                    foto: servicesData.find(s => s.id_layanan === item.id_layanan)?.foto || ''
                }));
            }
        }

        // Render Services
        function renderServices(services) {
            const grid = document.getElementById('servicesGrid');
            const emptyState = document.getElementById('emptyState');

            if (services.length === 0) {
                grid.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');

            grid.innerHTML = services.map(service => {
                const selected = getSelectedService(service.id_layanan);
                const isSelected = selected !== null;
                const quantity = selected ? selected.quantity : 1;

                return `
                <div class="service-card bg-white rounded-2xl shadow-md border-2 border-gray-100 ${isSelected ? 'selected' : ''}"
                    data-service-id="${service.id_layanan}"
                    onclick="toggleService('${service.id_layanan}', event)">

                    <!-- Image Container -->
                    <div class="p-1.5">
                        <div class="w-full border-2 border-gray-200 rounded-2xl h-40 bg-white overflow-hidden flex items-center justify-center">
                            <img
                                src="${getServiceImage(service)}"
                                alt="${service.nama_layanan}"
                                class="${getServiceImageClass(service)}"
                                loading="lazy"
                                onerror="this.onerror=null; this.src='${BASE_IMAGE}/d_laundry_20251205_163940_0000.png';"
                            >
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-bold text-gray-900 text-sm flex-1">
                                ${service.nama_layanan}
                            </h4>
                            <span class="px-2 py-1 ${service.jenis === 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700'} text-white text-xs rounded-full font-bold uppercase ml-2">
                                ${service.jenis}
                            </span>
                        </div>

                        <div class="mb-3">
                            <p class="text-lg font-bold text-purple-600">
                                Rp ${Number(service.harga).toLocaleString('id-ID')}
                            </p>
                            <p class="text-xs text-gray-500">
                                per ${service.jenis === 'kiloan' ? 'Kg' : 'Pcs'}
                            </p>
                        </div>

                        <!-- Quantity Controls -->
                        <div class="quantity-controls items-center justify-between gap-2">
                            <button 
                                onclick="decreaseQuantity('${service.id_layanan}', event)" 
                                class="qty-btn minus"
                                title="Kurangi">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            
                            <span class="qty-display" id="qty-${service.id_layanan}">${quantity}</span>
                            
                            <button 
                                onclick="increaseQuantity('${service.id_layanan}', event)" 
                                class="qty-btn plus"
                                title="Tambah">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                            
                            <button 
                                onclick="removeService('${service.id_layanan}', event)" 
                                class="qty-btn delete"
                                title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            }).join('');
        }

        // Toggle Service
        function toggleService(id, event) {
            if (event && (event.target.closest('.qty-btn') || event.target.closest('button'))) {
                return;
            }

            const service = servicesData.find(s => s.id_layanan === id);
            if (!service) return;

            const exists = getSelectedService(id);

            if (exists) {
                return;
            } else {
                selectedServices.push({
                    id_layanan: service.id_layanan,
                    nama_layanan: service.nama_layanan,
                    jenis: service.jenis,
                    harga: Number(service.harga),
                    quantity: 1,
                    foto: service.foto
                });
            }

            updateUI();
        }

        // Increase Quantity
        function increaseQuantity(id, event) {
            event.stopPropagation();
            
            const service = selectedServices.find(s => s.id_layanan === id);
            if (service) {
                service.quantity++;
                updateQuantityDisplay(id, service.quantity);
                saveCartToStorage();
            }
        }

        // Decrease Quantity
        function decreaseQuantity(id, event) {
            event.stopPropagation();
            
            const service = selectedServices.find(s => s.id_layanan === id);
            if (service) {
                if (service.quantity > 1) {
                    service.quantity--;
                    updateQuantityDisplay(id, service.quantity);
                    saveCartToStorage();
                } else {
                    removeService(id, event);
                }
            }
        }

        // Remove Service
        function removeService(id, event) {
            event.stopPropagation();
            
            const service = selectedServices.find(s => s.id_layanan === id);
            
            Swal.fire({
                title: 'Hapus dari keranjang?',
                text: `Yakin ingin menghapus ${service?.nama_layanan || 'layanan ini'}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7c3aed',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    selectedServices = selectedServices.filter(s => s.id_layanan !== id);
                    updateUI();
                }
            });
        }

        // Update Quantity Display
        function updateQuantityDisplay(id, quantity) {
            const qtyElement = document.getElementById(`qty-${id}`);
            if (qtyElement) {
                qtyElement.textContent = quantity;
            }
        }

        // Get Selected Service
        function getSelectedService(id) {
            return selectedServices.find(s => s.id_layanan === id) || null;
        }

        // Filter Services
        function filterServices(type) {
            currentFilter = type;

            document.querySelectorAll('.filter-button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            let filtered = servicesData;

            if (searchTerm) {
                filtered = filtered.filter(service =>
                    service.nama_layanan.toLowerCase().includes(searchTerm) ||
                    service.jenis.toLowerCase().includes(searchTerm)
                );
            }

            if (type !== 'semua') {
                filtered = filtered.filter(s => s.jenis === type);
            }

            renderServices(filtered);
        }

        // Update UI
        function updateUI() {
            renderServices(getCurrentFilteredServices());
            saveCartToStorage();
        }

        // Get Current Filtered Services
        function getCurrentFilteredServices() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            let filtered = servicesData;

            if (searchTerm) {
                filtered = filtered.filter(service =>
                    service.nama_layanan.toLowerCase().includes(searchTerm) ||
                    service.jenis.toLowerCase().includes(searchTerm)
                );
            }

            if (currentFilter !== 'semua') {
                filtered = filtered.filter(s => s.jenis === currentFilter);
            }

            return filtered;
        }

        // Save to localStorage
        function saveCartToStorage() {
            const cartItems = selectedServices.map(s => ({
                id_layanan: s.id_layanan,
                name: s.nama_layanan,
                price: s.harga,
                quantity: s.quantity
            }));

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            localStorage.setItem('cartCount', selectedServices.reduce((sum, s) => sum + s.quantity, 0));

            const event = new CustomEvent('cartUpdated', {
                detail: { count: selectedServices.reduce((sum, s) => sum + s.quantity, 0) }
            });
            window.dispatchEvent(event);
        }

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

</body>
</html>