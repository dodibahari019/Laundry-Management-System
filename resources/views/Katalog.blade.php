<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Layanan - D`Laundry</title>
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

        .filter-button {
            transition: all 0.3s ease;
        }

        .filter-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
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
    </style>
</head>
<body class="bg-gray-50">

    @include('landingPageComponent.navbar')

    <!-- Hero Section -->
    <section class="pt-32 pb-16 gradient-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center text-white fade-in">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                    Katalog Layanan<br/>
                    <span class="text-yellow-300">D`Laundry</span>
                </h1>
                <p class="text-xl mb-10 text-purple-100 leading-relaxed max-w-3xl mx-auto">
                    Temukan layanan laundry yang sesuai dengan kebutuhan Anda
                </p>
            </div>
        </div>

        <!-- Wave Bottom -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100L60 88.3C120 76.7 240 53.3 360 40C480 26.7 600 23.3 720 30C840 36.7 960 53.3 1080 60C1200 66.7 1320 63.3 1380 61.7L1440 60V100H1380C1320 100 1200 100 1080 100C960 100 840 100 720 100C600 100 480 100 360 100C240 100 120 100 60 100H0Z" fill="#F9FAFB"/>
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
                        class="search-input w-full px-6 py-5 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-lg shadow-lg"
                    >
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button onclick="filterServices('semua')" class="filter-button active px-8 py-4 rounded-2xl font-bold border-2 border-gray-200 bg-white text-gray-700">
                    Semua Layanan
                </button>
                <button onclick="filterServices('kiloan')" class="filter-button px-8 py-4 rounded-2xl font-bold border-2 border-gray-200 bg-white text-gray-700">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                    </svg>
                    Cuci Kiloan
                </button>
                <button onclick="filterServices('satuan')" class="filter-button px-8 py-4 rounded-2xl font-bold border-2 border-gray-200 bg-white text-gray-700">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    Cuci Satuan
                </button>
            </div>

            <!-- Stats Info -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                <div class="bg-white rounded-2xl p-6 text-center border-2 border-purple-100 hover-scale">
                    <div class="text-3xl font-bold gradient-text mb-2" id="totalServices">{{ $allLayanan->count() }}</div>
                    <div class="text-gray-600 font-medium">Total Layanan</div>
                </div>
                <div class="bg-white rounded-2xl p-6 text-center border-2 border-blue-100 hover-scale">
                    <div class="text-3xl font-bold text-blue-600 mb-2" id="kiloServices">{{ $layananKiloan->count() }}</div>
                    <div class="text-gray-600 font-medium">Layanan Kiloan</div>
                </div>
                <div class="bg-white rounded-2xl p-6 text-center border-2 border-orange-100 hover-scale">
                    <div class="text-3xl font-bold text-orange-600 mb-2" id="pieceServices">{{ $layananSatuan->count() }}</div>
                    <div class="text-gray-600 font-medium">Layanan Satuan</div>
                </div>
                <div class="bg-white rounded-2xl p-6 text-center border-2 border-green-100 hover-scale">
                    <div class="text-3xl font-bold text-green-600 mb-2">Aktif</div>
                    <div class="text-gray-600 font-medium">Status</div>
                </div>
            </div>

            <!-- Services Grid -->
            <div id="servicesGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
                @foreach($allLayanan as $layanan)
                <div class="service-card bg-white rounded-2xl shadow-md border-2 border-gray-100 hover:border-purple-300 hover-scale" data-type="{{ $layanan->jenis }}" data-name="{{ strtolower($layanan->nama_layanan) }}">
                    <div class="p-1.5">
                        <div class="w-full border-2 border-gray-200 rounded-2xl h-40 bg-white-50 overflow-hidden flex items-center justify-center">
                            @if($layanan->foto)
                            <img
                                src="{{ asset('storage/' . $layanan->foto) }}"
                                alt="{{ $layanan->nama_layanan }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                                onerror="this.onerror=null; this.src='{{ asset('image/d_laundry_20251205_163940_0000.png') }}';"
                            >
                            @else
                            <img
                                src="{{ asset('image/d_laundry_20251205_163940_0000.png') }}"
                                alt="{{ $layanan->nama_layanan }}"
                                class="max-w-[80%] max-h-[80%] object-contain"
                                loading="lazy"
                            >
                            @endif
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h4 class="font-bold text-gray-900 text-sm flex-1">
                                {{ $layanan->nama_layanan }}
                            </h4>
                            <span class="px-2 py-1 {{ $layanan->jenis === 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }} text-white text-xs rounded-full font-bold uppercase ml-2">
                                {{ $layanan->jenis }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div>
                                <p class="text-lg font-bold {{ $layanan->jenis === 'kiloan' ? 'text-purple-600' : 'text-orange-600' }}">
                                    Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    per {{ $layanan->jenis === 'kiloan' ? 'Kg' : 'Pcs' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-xs text-gray-500">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Selesai {{ $layanan->durasi }} hari
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-400 mb-2">Layanan Tidak Ditemukan</h3>
                <p class="text-gray-500">Coba gunakan kata kunci lain atau filter yang berbeda</p>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-12">
                <a href="/customer-orders" class="inline-flex items-center gap-3 gradient-primary text-white px-10 py-5 rounded-2xl font-bold text-lg hover:opacity-90 transition shadow-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Pesan Layanan Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @include('landingPageComponent.footer')

    <script>
        let currentFilter = 'semua';

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filterAndDisplay();
        });

        function filterServices(type) {
            currentFilter = type;

            // Update active filter button
            document.querySelectorAll('.filter-button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            filterAndDisplay();
        }

        function filterAndDisplay() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.service-card');
            const emptyState = document.getElementById('emptyState');
            let visibleCount = 0;

            cards.forEach(card => {
                const type = card.getAttribute('data-type');
                const name = card.getAttribute('data-name');
                
                let showCard = true;

                // Filter by type
                if (currentFilter !== 'semua' && type !== currentFilter) {
                    showCard = false;
                }

                // Filter by search
                if (searchTerm && !name.includes(searchTerm) && !type.includes(searchTerm)) {
                    showCard = false;
                }

                if (showCard) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
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