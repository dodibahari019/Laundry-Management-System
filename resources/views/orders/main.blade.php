@extends('layouts.frame')
@section('Title', 'Order')
@section('CssSection')

@endsection
@section('HeaderTitle', 'Manajemen Order')
@section('Description', 'Kelola pesanan laundry dari pelanggan')
@section('MainContentArea')
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Order</label>
                <div class="relative">
                    <input type="text" placeholder="Cari ID order atau nama pelanggan..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Diproses</option>
                    <option>Dicuci</option>
                    <option>Disetrika</option>
                    <option>Ready</option>
                    <option>Diambil</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>

            <!-- Button Add -->
            <div class="flex items-end">
                <button onclick="openAddOrderModal()" class="w-full px-4 py-2.5 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Order Baru</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <!-- Total Order -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Total Order</p>
            <h3 class="text-xl font-bold text-gray-900">247</h3>
        </div>

        <!-- Menunggu -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Menunggu</p>
            <h3 class="text-xl font-bold text-yellow-600">18</h3>
        </div>

        <!-- Diproses -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Diproses</p>
            <h3 class="text-xl font-bold text-orange-600">32</h3>
        </div>

        <!-- Ready -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Ready</p>
            <h3 class="text-xl font-bold text-green-600">45</h3>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Diambil</p>
            <h3 class="text-xl font-bold text-purple-600">152</h3>
        </div>
    </div>

    <!-- Table Orders -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Daftar Order</h2>
                <p class="text-sm text-gray-500 mt-1">Menampilkan 247 order aktif</p>
            </div>
            <div class="flex space-x-3">
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export</span>
                </button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Print</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            @include('orders.table')
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">1-10</span> dari <span class="font-semibold">247</span> order
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 disabled:opacity-50" disabled>
                    Previous
                </button>
                <button class="px-3 py-2 bg-purple-600 text-white rounded-lg text-sm font-semibold">1</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">2</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">3</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">
                    Next
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Add Order -->
    <div id="addOrderModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white z-10">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Order Baru</h2>
                    <p class="text-sm text-gray-500 mt-1">Buat pesanan laundry baru</p>
                </div>
                <button onclick="closeAddOrderModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form class="p-6 space-y-6">
                <!-- ID Order (Auto) -->
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-4 rounded-xl border border-purple-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">ID Order</p>
                            <p class="text-2xl font-bold gradient-text">OR-2024110029</p>
                        </div>
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pelanggan & Layanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pelanggan *</label>
                        <select id="selectPelanggan" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                            <option value="">-- Pilih Pelanggan --</option>
                            <option value="PL001">Budi Santoso - 0812-3456-7890</option>
                            <option value="PL002">Siti Aminah - 0813-9876-5432</option>
                            <option value="PL003">Ahmad Hidayat - 0856-7890-1234</option>
                            <option value="PL004">Dewi Lestari - 0821-4567-8901</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan *</label>
                        <select id="selectLayanan" onchange="hitungTotal()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                            <option value="">-- Pilih Layanan --</option>
                            <option value="LY001" data-harga="5000" data-jenis="kiloan">Cuci Kering - Rp 5.000/kg</option>
                            <option value="LY002" data-harga="8000" data-jenis="kiloan">Cuci + Setrika - Rp 8.000/kg</option>
                            <option value="LY003" data-harga="15000" data-jenis="kiloan">Express 6 Jam - Rp 15.000/kg</option>
                            <option value="LY004" data-harga="4000" data-jenis="kiloan">Setrika Saja - Rp 4.000/kg</option>
                            <option value="LY005" data-harga="25000" data-jenis="satuan">Cuci Jas - Rp 25.000/pcs</option>
                            <option value="LY006" data-harga="50000" data-jenis="satuan">Cuci Karpet - Rp 50.000/m²</option>
                        </select>
                    </div>
                </div>

                <!-- Berat/Jumlah & Estimasi -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span id="labelBerat">Berat (kg)</span> *
                        </label>
                        <input type="number" id="inputBerat" step="0.1" placeholder="0" onchange="hitungTotal()" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk *</label>
                        <input type="date" id="tanggalMasuk" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Selesai *</label>
                        <input type="date" id="estimasiSelesai" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    </div>
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Khusus</label>
                    <textarea rows="3" placeholder="Tambahkan catatan khusus (opsional)..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500"></textarea>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span id="subtotal" class="font-semibold text-gray-900">Rp 0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Biaya Tambahan</span>
                            <span class="font-semibold text-gray-900">Rp 0</span>
                        </div>
                        <div class="pt-3 border-t border-gray-300">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span id="totalHarga" class="text-2xl font-bold gradient-text">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Metode Pembayaran *</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="metode" value="cash" class="peer sr-only" checked>
                            <div class="p-4 border-2 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-purple-50 transition">
                                <div class="flex flex-col items-center space-y-2">
                                    <svg class="w-8 h-8 text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-semibold text-gray-700">Cash</span>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="metode" value="transfer" class="peer sr-only">
                            <div class="p-4 border-2 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-purple-50 transition">
                                <div class="flex flex-col items-center space-y-2">
                                    <svg class="w-8 h-8 text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    <span class="font-semibold text-gray-700">Transfer</span>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="metode" value="qris" class="peer sr-only">
                            <div class="p-4 border-2 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-purple-50 transition">
                                <div class="flex flex-col items-center space-y-2">
                                    <svg class="w-8 h-8 text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                    <span class="font-semibold text-gray-700">QRIS</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeAddOrderModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Buat Order</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('JavascriptSection')
<script>
    // Set today's date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggalMasuk').value = today;

    // Auto set estimasi selesai (3 days from today)
    const estimasi = new Date();
    estimasi.setDate(estimasi.getDate() + 3);
    document.getElementById('estimasiSelesai').value = estimasi.toISOString().split('T')[0];

    // Open/Close Modal
    function openAddOrderModal() {
        document.getElementById('addOrderModal').classList.remove('hidden');
    }

    function closeAddOrderModal() {
        document.getElementById('addOrderModal').classList.add('hidden');
    }

    // Change label based on service type
    document.getElementById('selectLayanan').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const jenis = selected.getAttribute('data-jenis');
        const labelBerat = document.getElementById('labelBerat');
        
        if (jenis === 'satuan') {
            labelBerat.textContent = 'Jumlah (pcs/m²)';
        } else {
            labelBerat.textContent = 'Berat (kg)';
        }
    });

    // Hitung Total
    function hitungTotal() {
        const layanan = document.getElementById('selectLayanan');
        const berat = document.getElementById('inputBerat').value;
        
        if (layanan.value && berat) {
            const selected = layanan.options[layanan.selectedIndex];
            const harga = parseFloat(selected.getAttribute('data-harga'));
            const beratFloat = parseFloat(berat);
            const total = harga * beratFloat;
            
            document.getElementById('subtotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
            document.getElementById('totalHarga').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }
    }
</script>
@endsection