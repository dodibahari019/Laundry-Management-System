<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white z-10">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Order Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Buat pesanan laundry baru</p>
    </div>
    <button onclick="closeCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<form action="/orders" method="POST" id="idCreateFormOrders" class="classCreateForm p-6 space-y-6 max-h-[70vh] overflow-y-auto">
    @csrf
    
    <!-- SECTION 1: KODE ORDER -->
    <div class="p-4 rounded-xl border border-gray-300 bg-gradient-to-r from-purple-50 to-blue-50">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Kode Order</p>
                <p class="text-2xl font-bold text-purple-600">{{$kodeOrder}}</p>
                <input hidden readonly name="kode_order" value="{{$kodeOrder}}" id="id_kode_order" type="text">
            </div>
            <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center shadow-md">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- SECTION 2: PELANGGAN -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center space-x-3 mb-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Informasi Pelanggan</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Pelanggan *</label>
                <select id="selectPelanggan" name="nama_pelanggan" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($dataPelanggan as $p)
                        <option value="{{ $p->id_pelanggan }}">{{$p->nama}} - {{$p->no_hp}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-1 flex items-end">
                <button type="button" onclick="ButtonCreatePelangganBaru();" class="w-full px-4 py-3 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    </div>

    <!-- SECTION 3: LAYANAN (MULTIPLE SELECTION) -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900">Pilih Layanan</h3>
            </div>
            <button type="button" onclick="addServiceRow()" class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Tambah Layanan</span>
            </button>
        </div>

        <!-- Container for service rows -->
        <div id="serviceRowsContainer" class="space-y-3">
            <!-- Initial row akan ditambahkan via JavaScript -->
        </div>
    </div>

    <!-- SECTION 4: TANGGAL -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center space-x-3 mb-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Jadwal & Estimasi</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk *</label>
                <input type="date" value="{{$currentlyDate}}" name="tanggal_masuk" id="tanggalMasuk" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Selesai *</label>
                <input type="date" value="{{$currentlyDate}}" name="tanggal_selesai" id="tanggalSelesai" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>
    </div>

    <!-- SECTION 5: RINGKASAN PEMBAYARAN -->
    <div class="bg-gradient-to-r from-purple-50 to-blue-50 border-2 border-purple-200 rounded-2xl p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h3>
        
        <div class="space-y-3 mb-4" id="summaryItemsList">
            <!-- Items akan ditampilkan di sini via JavaScript -->
        </div>

        <div class="pt-3 border-t-2 border-purple-300">
            <div class="flex items-center justify-between mb-4">
                <span class="text-lg font-bold text-gray-900">Total Harga</span>
                <span id="totalHarga" class="text-2xl font-bold text-purple-600">Rp 0</span>
                <input hidden readonly name="total" value="0" id="id_total" type="text">
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Metode Pembayaran *</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="metode" value="cash" class="peer sr-only" checked>
                        <div class="p-3 border-2 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-white transition">
                            <div class="flex flex-col items-center space-y-2">
                                <svg class="w-6 h-6 text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-semibold text-sm text-gray-700">Cash</span>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="metode" value="transfer" class="peer sr-only">
                        <div class="p-3 border-2 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-white transition">
                            <div class="flex flex-col items-center space-y-2">
                                <svg class="w-6 h-6 text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                <span class="font-semibold text-sm text-gray-700">Transfer</span>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="metode" value="qris" class="peer sr-only">
                        <div class="p-3 border-2 border-gray-300 rounded-xl peer-checked:border-purple-600 peer-checked:bg-white transition">
                            <div class="flex flex-col items-center space-y-2">
                                <svg class="w-6 h-6 text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                                <span class="font-semibold text-sm text-gray-700">QRIS</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Total Bayar & Kembalian -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Total Bayar *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                        <input name="totalBayar" oninput="HitungKembalian(this.value)" id="id_totalBayar" type="text" placeholder="0" class="w-full pl-12 text-right pr-6 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kembalian</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                        <input readonly name="kembalian" id="id_kembalian" type="text" placeholder="0" class="w-full pl-12 text-right pr-6 py-3 border border-gray-300 rounded-xl bg-gray-50">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 sticky bottom-0 bg-white">
        <button type="button" onclick="closeCrudModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="button" onclick="ValidateCreateOrder()" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            <span>Simpan Order</span>
        </button>
    </div>
</form>

<script>
let serviceCounter = 0;
let selectedServices = [];

// Data layanan dari backend
const dataLayanan = @json($dataLayanan);

// Initialize first row
document.addEventListener('DOMContentLoaded', function() {
    addServiceRow();
});

// Add service row
function addServiceRow() {
    serviceCounter++;
    const container = document.getElementById('serviceRowsContainer');
    
    const row = document.createElement('div');
    row.className = 'service-row border border-gray-200 rounded-xl p-4';
    row.id = `service-row-${serviceCounter}`;
    row.dataset.rowId = serviceCounter;
    
    row.innerHTML = `
        <div class="grid grid-cols-12 gap-3 items-end">
            <!-- Layanan -->
            <div class="col-span-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                <select onchange="selectService(${serviceCounter}, this)" class="service-select w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">-- Pilih Layanan --</option>
                    ${dataLayanan.map(l => `
                        <option value="${l.id_layanan}" 
                            data-harga="${l.harga}" 
                            data-jenis="${l.jenis}"
                            data-durasi="${l.durasi}">
                            ${l.nama_layanan} - Rp ${Number(l.harga).toLocaleString('id-ID')}/${l.jenis === 'kiloan' ? 'Kg' : 'Pcs'}
                        </option>
                    `).join('')}
                </select>
            </div>
            
            <!-- Qty -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Qty</label>
                <input type="number" 
                    min="1" 
                    value="1" 
                    oninput="calculateRowSubtotal(${serviceCounter})" 
                    class="qty-input w-full px-4 py-3 border border-gray-300 rounded-xl text-center focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
            
            <!-- Harga -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                <input type="text" readonly class="harga-display w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-right">
                <input type="hidden" class="harga-value">
            </div>
            
            <!-- Subtotal -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Subtotal</label>
                <input type="text" readonly class="subtotal-display w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-right font-bold text-purple-600">
                <input type="hidden" class="subtotal-value">
            </div>
            
            <!-- Delete Button -->
            <div class="col-span-1">
                <button type="button" onclick="removeServiceRow(${serviceCounter})" class="w-full px-3 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                    <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;
    
    container.appendChild(row);
}

// Select service handler
function selectService(rowId, selectElement) {
    const row = document.getElementById(`service-row-${rowId}`);
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    
    if (selectedOption.value) {
        const harga = parseFloat(selectedOption.dataset.harga);
        const jenis = selectedOption.dataset.jenis;
        const durasi = parseFloat(selectedOption.dataset.durasi);
        
        // Set harga
        row.querySelector('.harga-value').value = harga;
        row.querySelector('.harga-display').value = `Rp ${harga.toLocaleString('id-ID')}`;
        
        // Calculate subtotal
        calculateRowSubtotal(rowId);
        
        // Auto update tanggal selesai based on durasi
        updateTanggalSelesai(durasi);
    }
}

// Calculate row subtotal
function calculateRowSubtotal(rowId) {
    const row = document.getElementById(`service-row-${rowId}`);
    const harga = parseFloat(row.querySelector('.harga-value').value) || 0;
    const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
    
    const subtotal = harga * qty;
    
    row.querySelector('.subtotal-value').value = subtotal;
    row.querySelector('.subtotal-display').value = `Rp ${subtotal.toLocaleString('id-ID')}`;
    
    // Update total keseluruhan
    updateGrandTotal();
}

// Update grand total
function updateGrandTotal() {
    const allSubtotals = document.querySelectorAll('.subtotal-value');
    let grandTotal = 0;
    
    // Prepare items array
    selectedServices = [];
    
    document.querySelectorAll('.service-row').forEach((row, index) => {
        const select = row.querySelector('.service-select');
        const qty = row.querySelector('.qty-input').value;
        const harga = row.querySelector('.harga-value').value;
        const subtotal = row.querySelector('.subtotal-value').value;
        
        if (select.value && qty && harga) {
            grandTotal += parseFloat(subtotal);
            
            selectedServices.push({
                id_layanan: select.value,
                qty: qty,
                harga: harga,
                subtotal: subtotal
            });
        }
    });
    
    document.getElementById('totalHarga').textContent = `Rp ${grandTotal.toLocaleString('id-ID')}`;
    document.getElementById('id_total').value = grandTotal;
    
    // Update summary
    updateSummary();
}

// Update summary list
function updateSummary() {
    const summaryContainer = document.getElementById('summaryItemsList');
    
    if (selectedServices.length === 0) {
        summaryContainer.innerHTML = '<p class="text-sm text-gray-500 text-center py-3">Belum ada layanan dipilih</p>';
        return;
    }
    
    let html = '';
    selectedServices.forEach((item, index) => {
        const layanan = dataLayanan.find(l => l.id_layanan === item.id_layanan);
        if (layanan) {
            html += `
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-700">${layanan.nama_layanan} (${item.qty} ${layanan.jenis === 'kiloan' ? 'Kg' : 'Pcs'})</span>
                    <span class="font-semibold text-gray-900">Rp ${parseFloat(item.subtotal).toLocaleString('id-ID')}</span>
                </div>
            `;
        }
    });
    
    summaryContainer.innerHTML = html;
}

// Remove service row
function removeServiceRow(rowId) {
    const row = document.getElementById(`service-row-${rowId}`);
    if (document.querySelectorAll('.service-row').length > 1) {
        row.remove();
        updateGrandTotal();
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Minimal harus ada 1 layanan',
            confirmButtonColor: '#7c3aed'
        });
    }
}

// Update tanggal selesai based on durasi
function updateTanggalSelesai(durasi) {
    const tanggalMasukInput = document.getElementById('tanggalMasuk');
    const tanggalSelesaiInput = document.getElementById('tanggalSelesai');
    
    const tanggalMasuk = new Date(tanggalMasukInput.value);
    let tanggalSelesai = new Date(tanggalMasuk);
    
    if (durasi >= 24) {
        const hari = Math.ceil(durasi / 24);
        tanggalSelesai.setDate(tanggalSelesai.getDate() + hari);
    }
    
    const yyyy = tanggalSelesai.getFullYear();
    const mm = String(tanggalSelesai.getMonth() + 1).padStart(2, '0');
    const dd = String(tanggalSelesai.getDate()).padStart(2, '0');
    tanggalSelesaiInput.value = `${yyyy}-${mm}-${dd}`;
}

// Hitung kembalian
function HitungKembalian(totalBayar) {
    let total = parseFloat(document.getElementById('id_total').value) || 0;
    let bayarBersih = totalBayar.replace(/[^0-9]/g, '');
    let bayar = parseFloat(bayarBersih) || 0;
    
    let kembalian = (bayar - total) >= 0 ? (bayar - total) : 0;
    
    const formatRp = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(kembalian);
    
    document.getElementById('id_kembalian').value = formatRp;
    
    const formatBayar = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(bayar);
    
    document.getElementById('id_totalBayar').value = formatBayar;
}

// Validate create order
function ValidateCreateOrder() {
    const pelanggan = document.getElementById('selectPelanggan').value;
    const total = parseInt(document.getElementById('id_total').value) || 0;
    const totalBayarRaw = document.getElementById('id_totalBayar').value;
    const totalBayarClean = totalBayarRaw.replace(/[^0-9]/g, '');
    const totalBayar = parseInt(totalBayarClean) || 0;
    
    if (!pelanggan) {
        return Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#6D28D9',
            title: 'Peringatan',
            text: 'Harap pilih pelanggan!',
            timer: 2000,
            timerProgressBar: true
        });
    }
    
    if (selectedServices.length === 0) {
        return Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#6D28D9',
            title: 'Peringatan',
            text: 'Harap pilih minimal 1 layanan!',
            timer: 2000,
            timerProgressBar: true
        });
    }
    
    if (total <= 0) {
        return Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#6D28D9',
            title: 'Peringatan',
            text: 'Total harga belum dihitung!',
            timer: 2000,
            timerProgressBar: true
        });
    }
    
    if (!totalBayarRaw) {
        return Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#6D28D9',
            title: 'Peringatan',
            text: 'Harap isi total bayar!',
            timer: 2000,
            timerProgressBar: true
        });
    }
    
    if (totalBayar < total) {
        return Swal.fire({
            icon: 'error',
            confirmButtonColor: '#6D28D9',
            title: 'Pembayaran Kurang!',
            text: 'Total bayar masih kurang dari total harga!',
            timer: 2500,
            timerProgressBar: true
        });
    }
    
    // Tambahkan items ke form sebagai hidden inputs
    const form = document.getElementById('idCreateFormOrders');
    selectedServices.forEach((item, index) => {
        Object.keys(item).forEach(key => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `items[${index}][${key}]`;
            input.value = item[key];
            form.appendChild(input);
        });
    });
    
    form.submit();
}
</script>