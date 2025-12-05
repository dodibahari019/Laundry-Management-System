<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white z-10">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Order</h2>
        <p class="text-sm text-gray-500 mt-1">Edit pesanan laundry</p>
    </div>
    <button onclick="closeCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@foreach($dataOrder as $orders)   
<form action="/orders/{{ $orders->id_order }}/{{ $orders->id_pembayaran }}" method="POST" id="idEditFormOrders" class="classEditForm p-6 space-y-6">
    @csrf
    @method('PUT')
    <!-- ID Order (Auto) -->
    <div class="p-4 rounded-xl border border-gray-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Kode Order</p>
                <p class="text-2xl font-bold text-purple-600">{{ $orders->kode_order }}</p>
                <input readonly hidden name="kode_order" value="{{ $orders->kode_order }}" id="id_kode_order_edit" type="text" class="w-full px-2 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
            {{-- <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div> --}}
        </div>
    </div>

    <!-- Pelanggan & Layanan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="col-span-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Pelanggan *</label>
            <select readonly id="selectPelanggan_edit" name="nama_pelanggan" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <option selected value="{{ $orders->id_pelanggan }}">{{ $orders->nama }} - {{ $orders->no_hp}}</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
         <div class="col-span-3">
            <label class="block text-sm font-medium text-gray-700 mb-2">Layanan *</label>
            <select name="jenis_layanan" id="selectLayanan_edit" onchange="ChooseSatuanEdit(this)" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <option selected value="{{ $orders->id_layanan }}" data-layanan-edit="{{$orders->nama_layanan}}" data-harga-edit="{{$orders->harga}}" data-durasi-edit="{{$orders->durasi}}" data-jenis-edit="{{$orders->jenis}}">{{$orders->nama_layanan}} - Rp {{number_format($orders->harga,0,',' , '.')}}/{{$orders->jenis == 'kiloan'? 'Kg' : 'Pcs'}}</option>
                @foreach($dataLayanan as $l)
                    <option value="{{$l->id_layanan}}" data-layanan-edit="{{$l->nama_layanan}}" data-harga-edit="{{$l->harga}}" data-durasi-edit="{{$l->durasi}}" data-jenis-edit="{{$l->jenis}}">{{$l->nama_layanan}} - Rp {{number_format($l->harga,0,',' , '.')}}/{{$l->jenis == 'kiloan'? 'Kg' : 'Pcs'}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <span id="labelBeratEdit">Berat (kg)</span> *
            </label>
            <input {{ $orders->jenis != 'kiloan' ? 'readonly' : '' }} name="berat" value="{{ fmod($orders->berat, 1) == 0 ? intval($orders->berat) : $orders->berat }}" type="number" step="0.01" min="0" oninput="JustHitungTotalEdit(this.value);" id="id_berat_edit" placeholder="0" class="classRps w-full text-right pr-2 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <div class="col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <span id="labelQtyEdit">Qty (pcs)</span> *
            </label>
            <input {{ $orders->jenis == 'kiloan' ? 'readonly' : '' }} name="qty" value="{{$orders->qty}}" type="number" step="1" min="0" oninput="JustHitungTotalEdit(this.value);" id="id_qty_edit" placeholder="0" class="classRps w-full text-right pr-2 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk *</label>
            <input type="date" value="{{ \Carbon\Carbon::parse($orders->tanggal_masuk)->format('Y-m-d') }}" readonly name="tanggal_masuk" id="tanggalMasuk_edit" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Selesai *</label>
            <input type="date" value="{{ \Carbon\Carbon::parse($orders->tanggal_selesai)->format('Y-m-d') }}" readonly name="tanggal_selesai" id="tanggalSelesai_edit" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>

    <!-- Catatan -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
        <textarea rows="3" name="catatan" id="id_catatan_edit" placeholder="Tambahkan catatan khusus (opsional)..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">{{ $orders->catatan }}</textarea>
    </div>

    <!-- Ringkasan Pembayaran -->
    <div class="bg-white p-6 rounded-xl border border-gray-300">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span id="idServicesThatYouChoose_edit" class="text-gray-600">{{ $orders->nama_layanan }} ({{ $orders->jenis == 'kiloan'? $orders->berat . 'Kg' : $orders->qty . 'Pcs' }})</span>
                <span id="subtotal_edit" class="font-semibold text-gray-900">Rp{{number_format($orders->total,0,',' , '.')}}</span>
            </div>
            <div class="pt-3 border-t border-gray-300">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-gray-900">Total</span>
                    <span id="totalHarga_edit" class="text-2xl font-bold gradient-text">Rp {{number_format($orders->total,0,',' , '.')}}</span>
                    <input hidden readonly name="total" id="id_total_edit" value="{{ intval($orders->total) }}" type="text" class="classRps w-full px-2 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                </div>
            </div>
        </div>
    </div>

    <!-- Metode Pembayaran -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">Metode Pembayaran *</label>
        <div class="grid grid-cols-3 gap-4">
            <label class="relative cursor-pointer">
                <input type="radio" name="metode" value="cash" class="peer sr-only" {{ $orders->metode == 'cash' ? 'checked' : '' }}>
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
                <input type="radio" name="metode" value="transfer" class="peer sr-only" {{ $orders->metode == 'transfer' ? 'checked' : '' }}>
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
                <input type="radio" name="metode" value="qris" class="peer sr-only" {{ $orders->metode == 'qris' ? 'checked' : '' }}>
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

    {{-- TOTAL BAYAR USER --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Total Bayar *</label>
            <div class="relative">
                <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                <input name="totalBayar" value="{{number_format($orders->jumlah,0,',' , '.')}}" oninput="HitungKembalianEdit(this.value)" id="id_totalBayar_edit" type="text" placeholder="0" class="classRp w-full pl-12 text-right pr-6 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kembalian</label>
            <div class="relative">
                <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                <input readonly name="kembalian" value="{{number_format($orders->kembalian,0,',' , '.')}}" id="id_kembalian_edit" type="text" placeholder="0" class="w-full pl-12 text-right pr-6 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeCrudModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="button" onclick="ValidateCreateOrderEdit()" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg> --}}
            <span>Simpan</span>
        </button>
    </div>
</form>
@endforeach
