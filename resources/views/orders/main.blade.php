@extends('layouts.frame')
@section('Title', 'Orders')
@section('CssSection')

@endsection
@section('HeaderTitle', 'Manajemen Order')
@section('Description', 'Kelola pesanan laundry dari pelanggan')
@section('MainContentArea')
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        @php
            $size = 4;
            if($role_login != 'petugas'){
                $size = 5;
            }
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Order</label>
                <div class="relative">
                    <input id="searchOrder" type="text" placeholder="Cari Kode order atau nama pelanggan..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="filterStatus" class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="dicuci">Dicuci</option>
                    <option value="disetrika">Disetrika</option>
                    <option value="ready">Ready</option>
                    <option value="diambil">Diambil</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Order</label>
                <input id="filterTanggal" type="date" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>

            <!-- Button Add -->
            {{-- @if($role_login != 'petugas')
                <div class="flex items-end">
                    <button data-url="/orders/create" class="modal-crud w-full px-4 py-3 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Tambah</span>
                    </button>
                </div>
            @endif --}}
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <!-- Total Order -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Total Order</p>
            <h3 class="text-xl font-bold text-purple-900">{{$totalOrder}}</h3>
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
            <h3 class="text-xl font-bold text-yellow-600">{{$totalMenunggu}}</h3>
        </div>

        <!-- Diproses -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Diproses, Dicuci, Disetrika</p>
            <h3 class="text-xl font-bold text-blue-600">{{$totalDiproses}}</h3>
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
            <h3 class="text-xl font-bold text-green-600">{{$totalReady}}</h3>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mb-1">Diambil</p>
            <h3 class="text-xl font-bold text-gray-600">{{$totalDiambil}}</h3>
        </div>
    </div>

    <!-- Table Orders -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Daftar Order</h2>
                <p id="jumlahLayananInfoOrders" class="text-sm text-gray-500 mt-1">Menampilkan {{ $totalOrder }} order aktif</p>
            </div>
            {{-- <div class="flex space-x-3">
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
            </div> --}}
        </div>

        <div class="overflow-x-auto">
            @include('orders.table')
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                {{-- Menampilkan <span class="font-semibold">1-10</span> dari <span class="font-semibold">247</span> order --}}
            </div>
            <div id="paginationOrdersContainer" class="flex space-x-2">
                @if($dataOrder->onFirstPage())
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Previous</button>
                @else
                    <button data-page="{{ $dataOrder->currentPage() - 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Previous</button>
                @endif

                @foreach ($dataOrder->getUrlRange(1, $dataOrder->lastPage()) as $page => $url)
                    <button data-page="{{ $page }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ $dataOrder->currentPage() == $page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50' }}">
                        {{ $page }}
                    </button>
                @endforeach

                @if($dataOrder->hasMorePages())
                    <button data-page="{{ $dataOrder->currentPage() + 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Next</button>
                @else
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Next</button>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('JavascriptSection')
<script>
    // Fungsi Format Tanggal → "30 Nov 2025"
    function formatTanggal(tanggal) {
        if (!tanggal) return '-';

        const bulan = [
            "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
            "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
        ];

        let dateObj = new Date(tanggal);

        if (isNaN(dateObj)) return tanggal;

        let hari = dateObj.getDate();
        let bulanText = bulan[dateObj.getMonth()];
        let tahun = dateObj.getFullYear();

        return `${hari} ${bulanText} ${tahun}`;
    }

    function formatTanggalWaktu(tanggal) {
        if (!tanggal) return '-';

        const bulan = [
            "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
            "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
        ];

        let dateObj = new Date(tanggal);
        if (isNaN(dateObj)) return tanggal; // kalau gagal parse

        let hari = dateObj.getDate();
        let bulanText = bulan[dateObj.getMonth()];
        let tahun = dateObj.getFullYear();

        // ambil jam-menit
        let jam = dateObj.getHours().toString().padStart(2, '0');
        let menit = dateObj.getMinutes().toString().padStart(2, '0');
        let detik = dateObj.getSeconds().toString().padStart(2, '0');

        // cek apakah input punya waktu (timestamp > 00:00:00)
        let adaWaktu = tanggal.toString().includes(':') ||
                        dateObj.getHours() !== 0 ||
                        dateObj.getMinutes() !== 0 ||
                        dateObj.getSeconds() !== 0;

        return `${hari} ${bulanText} ${tahun} ${jam}:${menit}`;
    }

    function formatBerat(value) {
        // Ubah ke float
        let num = parseFloat(value);

        // Format max 2 decimal
        let str = num.toFixed(2); // contoh: 3.00, 3.50, 4.00

        // Hilangkan 0 di belakang
        str = str.replace(/\.?0+$/, '');
        // - Kalau .00 → hilang jadi '' → angka bulat
        // - Kalau .50 → jadi .5

        // Ganti titik menjadi koma
        str = str.replace('.', ',');

        return str;
    }

    // function updateTableOrders(res) {
    //     let html = '';
    //     const ROLE = "{{ $role_login }}";
    //     if (res.data && res.data.length > 0) {
    //         res.data.forEach((x, index) => {
    //             // Nomor urut
    //             let nomor = (res.current_page - 1) * res.per_page + index + 1;

    //             let jenisColor = x.jenis == 'kiloan'? 'bg-blue-100 text-blue-700': 'bg-purple-100 text-purple-700';
    //             let beratQtyRaw = x.jenis == 'kiloan'? x.berat : x.jumlah;
    //             let satuan = x.jenis == 'kiloan'? 'Kg' : 'Pcs';

    //             let beratQty = formatBerat(beratQtyRaw);

    //             let statusLaundry = x.status_order;
    //             let statusColor = 'bg-yellow-100 text-yellow-700';
    //             if(statusLaundry == 'menunggu'){
    //                 statusColor = 'bg-yellow-100 text-yellow-700';
    //             } else if(statusLaundry == 'diproses'){
    //                 statusColor = 'bg-blue-100 text-blue-700';
    //             } else if(statusLaundry == 'dicuci'){
    //                 statusColor = 'bg-orange-100 text-orange-700';
    //             } else if(statusLaundry == 'disetrika'){
    //                 statusColor = 'bg-purple-100 text-purple-700';
    //             } else if(statusLaundry == 'ready'){
    //                 statusColor = 'bg-green-100 text-green-700';
    //             } else if(statusLaundry == 'diambil'){
    //                 statusColor = 'bg-gray-100 text-gray-700';
    //             } else {
    //                 statusColor = 'bg-red-100 text-red-700';
    //             }

    //             let icon = x.status_order == 'diambil'?
    //                 `<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    //                 </svg>`
    //             :
    //                 `<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    //                 </svg>`;

    //             let estimasi = x.status_order == 'diambil'? 'Selesai' : formatTanggal(x.tanggal_selesai);

    //             html += `
    //              <tr class="hover:bg-gray-50 transition">
    //                 <td class="py-4 px-6">
    //                     <span class="font-semibold text-gray-900">${nomor}</span>
    //                 </td>
    //                 <td class="py-4 px-6">
    //                     <div>
    //                         <p class="font-semibold text-purple-600">#${x.kode_order}</p>
    //                         <p class="text-xs text-gray-500">${formatTanggalWaktu(x.tanggal_masuk)}</p>
    //                     </div>
    //                 </td>
    //                 <td class="py-4 px-6">
    //                     <div>
    //                         <p class="font-semibold text-gray-900">${x.nama}</p>
    //                         <p class="text-xs text-gray-500">${x.no_hp}</p>
    //                     </div>
    //                 </td>
    //                 <td class="py-4 px-6">
    //                     <div>
    //                         <p class="text-sm font-medium text-gray-900">${x.nama_layanan}</p>
    //                         <p class="text-xs text-gray-500">${x.jenis}</p>
    //                     </div>
    //                 </td>
    //                 <td class="py-4 px-6 text-center">
    //                     <span class="${jenisColor} px-3 py-1 rounded-full text-xs font-bold">${beratQty} ${satuan}</span>
    //                 </td>
    //                 <td class="py-4 px-6 text-right">
    //                     <p class="font-bold text-gray-900">Rp ${(Number(x.total)).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</p>
    //                 </td>
    //                 <td class="py-4 px-6">
    //                     <div class="flex justify-center">
    //                         <span class="${statusColor} px-3 py-1 rounded-full text-xs font-bold">${x.status_order}</span>
    //                     </div>
    //                 </td>
    //                 <td class="py-4 px-6">
    //                     <div class="flex items-center space-x-2">
    //                         ${icon}
    //                         <span class="text-sm text-gray-900">${estimasi}</span>
    //                     </div>
    //                 </td>
    //                 <td class="py-4 px-6">
    //                     <div class="flex items-center justify-center space-x-2">
    //                         <button data-url-detail="/orders/${x.id_order}/detail" class="detail-modal-crud text-blue-600 hover:text-blue-800 p-1" title="Detail">
    //                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
    //                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
    //                             </svg>
    //                         </button>
    //                         ${ROLE != 'petugas' ? `
    //                             <button data-url="/orders/${x.id_order}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
    //                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
    //                                 </svg>
    //                             </button>
    //                         ` : '' }
    //                     </div>
    //                 </td>
    //             </tr>
    //             `;
    //         });
    //     } else {
    //         html = `<tr><td colspan="9" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
    //     }

    //     $('#idBodyTableOrders').html(html);
    // }

    // Update JavaScript untuk table orders dengan multiple services
    function updateTableOrders(res) {
        let html = '';
        const ROLE = "{{ $role_login ?? 'admin' }}";
        
        if (res.data && res.data.length > 0) {
            res.data.forEach((x, index) => {
                // Nomor urut
                let nomor = (res.current_page - 1) * res.per_page + index + 1;

                // Jumlah layanan badge color
                let jumlahLayananColor = 'bg-blue-100 text-blue-700';

                let statusLaundry = x.status_order;
                let statusColor = 'bg-yellow-100 text-yellow-700';
                if(statusLaundry == 'menunggu'){
                    statusColor = 'bg-yellow-100 text-yellow-700';
                } else if(statusLaundry == 'diproses'){
                    statusColor = 'bg-blue-100 text-blue-700';
                } else if(statusLaundry == 'dicuci'){
                    statusColor = 'bg-orange-100 text-orange-700';
                } else if(statusLaundry == 'disetrika'){
                    statusColor = 'bg-purple-100 text-purple-700';
                } else if(statusLaundry == 'ready'){
                    statusColor = 'bg-green-100 text-green-700';
                } else if(statusLaundry == 'diambil'){
                    statusColor = 'bg-gray-100 text-gray-700';
                } else {
                    statusColor = 'bg-red-100 text-red-700';
                }

                let icon = x.status_order == 'diambil'?
                    `<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>`
                :
                    `<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>`;

                let estimasi = x.status_order == 'diambil'? 'Selesai' : formatTanggal(x.tanggal_selesai);

                // Jumlah layanan
                let jumlahLayanan = x.jumlah_layanan || 0;

                html += `
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-4 px-6">
                        <span class="font-semibold text-gray-900">${nomor}</span>
                    </td>
                    <td class="py-4 px-6">
                        <div>
                            <p class="font-semibold text-purple-600">#${x.kode_order}</p>
                            <p class="text-xs text-gray-500">${formatTanggalWaktu(x.tanggal_masuk)}</p>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div>
                            <p class="font-semibold text-gray-900">${x.nama}</p>
                            <p class="text-xs text-gray-500">${x.no_hp}</p>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <span class="${jumlahLayananColor} px-3 py-1 rounded-full text-xs font-bold">${jumlahLayanan} Layanan</span>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <p class="font-bold text-gray-900">Rp ${(Number(x.total)).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</p>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex justify-center">
                            <span class="${statusColor} px-3 py-1 rounded-full text-xs font-bold uppercase">${x.status_order}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-2">
                            ${icon}
                            <span class="text-sm text-gray-900">${estimasi}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-center space-x-2">
                            <button data-url-detail="/orders/${x.id_order}/detail" class="detail-modal-crud text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                `;
            });
        } else {
            html = `<tr><td colspan="8" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
        }

        $('#idBodyTableOrders').html(html);
    }
    
    function updateInfoOrders(res) {
        // Update jumlah layanan
        $('#jumlahLayananInfoOrders').html(
            `Menampilkan ${res.total} order aktif`
        );

        // Update pagination
        let paginationHtml = '';

        // Previous
        if (res.current_page > 1) {
            paginationHtml += `<button data-page="${res.current_page - 1}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Previous</button>`;
        } else {
            paginationHtml += `<button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 opacity-50">Previous</button>`;
        }

        // Page numbers
        for (let page = 1; page <= res.last_page; page++) {
            paginationHtml += `<button data-page="${page}" class="px-3 py-2 rounded-lg text-sm font-semibold ${res.current_page == page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50'}">${page}</button>`;
        }

        // Next
        if (res.current_page < res.last_page) {
            paginationHtml += `<button data-page="${res.current_page + 1}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Next</button>`;
        } else {
            paginationHtml += `<button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 opacity-50">Next</button>`;
        }

        $('#paginationOrdersContainer').html(paginationHtml);
    }

    // Event delegation untuk pagination
    $(document).on('click', '#paginationOrdersContainer button[data-page]', function() {
        let page = $(this).data('page');
        fetchDataorders(page); // panggil fetchDataorders dengan page tertentu
    });


    // Event delegation untuk pagination
    $(document).on('click', '.page-btn', function() {
        let page = $(this).data('page');
        fetchDataorders(page);
    });

    let timer;
    function fetchDataorders(page = 1) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let order = $('#searchOrder').val();
            let status = $('#filterStatus').val();
            let tanggal = $('#filterTanggal').val();

            $.ajax({
                url: '/orders/search',
                type: 'GET',
                data: { order: order, status: status, tanggal: tanggal, page: page
                 },
                success: function(res) {
                    updateTableOrders(res);
                    updateInfoOrders(res);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }, 400);
    }

    // Event listener
    // $('#searchOrder, #filterStatus, #filterTanggal').on('keyup change', () => fetchDataorders());
    $('#searchOrder').on('keyup', () => fetchDataorders());
    $('#filterStatus, #filterTanggal').on('change', () => fetchDataorders());
</script>
<script>
    function ButtonCreatePelangganBaru(event) {
        if (event) event.preventDefault(); // cegah submit form

        let modal = document.getElementById("crudSubModal");
        modal.classList.remove("hidden");

        fetch("/orders/create-pelanggan")
            .then(res => res.text())
            .then(html => {
                document.getElementById("subModalContent").innerHTML = html;
            });
    }

    function JustRunThisButtonOrders(){
        let nama = document.getElementById('id_nama').value;
        let no_hp = document.getElementById('id_no_hp').value;
        let email = document.getElementById('id_email').value;
        let alamat = document.getElementById('id_alamat').value;

        if(nama == '' || nama == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Nama Pelanggan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(no_hp == '' || no_hp == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi No Hp Pelanggan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(email == '' || email == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Email Pelanggan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if (alamat == '' || alamat == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Alamat Pelanggan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else {
            MakeNewPelangganButton();
        }
    }

    function MakeNewPelangganButton() {
        let formData = {
            nama: $("#id_nama").val(),
            no_hp: $("#id_no_hp").val(),
            email: $("#id_email").val(),
            alamat: $("#id_alamat").val(),
            _token: $("input[name=_token]").val()
        };

        $.ajax({
            url: "/orders/pelanggan",
            type: "POST",
            data: formData,
            success: function(res) {
                if (res.success) {

                    closeCrudSubModal();

                    let newOption =
                        `<option value="${res.data.id_pelanggan}">
                            ${res.data.nama} - ${res.data.no_hp}
                        </option>`;

                    $("#selectPelanggan").append(newOption);

                    $("#selectPelanggan").val(res.data.id_pelanggan);

                    $("#idCreateSubForm")[0].reset();

                    Swal.fire({
                        confirmButtonColor: "#6D28D9",
                        title: "Success!",
                        text: "Pelanggan berhasil ditambahkan!",
                        icon: "success",
                        timer:1000
                    });

                } else {
                    Swal.fire("Error", res.message, "error");
                }
            },
            error: function(xhr) {
                Swal.fire("Error", "Terjadi kesalahan server", "error");
            }
        });
    }
</script>
<script>
function ValidateCreateOrder() {
    let pelanggan = document.getElementById('selectPelanggan').value;
    let layanan = document.getElementById('selectLayanan').value;
    let berat = document.getElementById('id_berat').value;
    let qty = document.getElementById('id_qty').value;

    let total = document.getElementById('id_total').value || "0";

    let totalBayarRaw = document.getElementById('id_totalBayar').value;
    let totalBayarClean = totalBayarRaw.replace(/[^0-9]/g, '');
    let totalBayar = parseInt(totalBayarClean) || 0;

    let totalInt = parseInt(total) || 0;

    if (pelanggan === "") {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap pilih pelanggan!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (layanan === "") {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap pilih layanan!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if ((berat == "" || berat == 0) && (qty == "" || qty == 0)) {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap isi berat atau qty!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (totalInt <= 0) {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Total harga belum dihitung!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (totalBayarRaw === "") {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap isi total bayar!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (totalBayar < totalInt) {
        return Swal.fire({
            icon: "error",
            confirmButtonColor: "#6D28D9",
            title: "Pembayaran Kurang!",
            text: "Total bayar masih kurang dari total harga!",
            timer: 2500,
            timerProgressBar: true
        });
    } else {
        document.getElementById('idCreateFormOrders').submit();
    }
}
</script>
<script>
    function ChooseSatuan(selectElement){
        // ambil option yang dipilih
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const jenisLayanan = selectedOption.getAttribute('data-layanan');
        const jenisSatuan = selectedOption.getAttribute('data-jenis'); // 'kiloan' atau 'pcs'
        const durasi = parseFloat(selectedOption.getAttribute('data-durasi')); // dalam jam

        if(jenisSatuan == 'kiloan'){
            document.getElementById('id_berat').removeAttribute('readonly');
            document.getElementById('id_berat').value = 0;
            document.getElementById('id_qty').setAttribute('readonly', true);
            document.getElementById('id_qty').value = 0;
        }else{
            document.getElementById('id_berat').setAttribute('readonly', true);
            document.getElementById('id_berat').value = 0;
            document.getElementById('id_qty').removeAttribute('readonly');
            document.getElementById('id_qty').value = 0;
        }

        // Hitung tanggal selesai
        const tanggalMasukInput = document.getElementById('tanggalMasuk');
        const tanggalSelesaiInput = document.getElementById('tanggalSelesai');

        const tanggalMasuk = new Date(tanggalMasukInput.value); // ambil tanggal masuk
        let tanggalSelesai = new Date(tanggalMasuk); // clone tanggal masuk

        if(durasi >= 24){
            // durasi lebih dari 1 hari, hitung jumlah hari, genapi ke atas
            const hari = Math.ceil(durasi / 24);
            tanggalSelesai.setDate(tanggalSelesai.getDate() + hari);
        }
        // durasi < 24 jam, tanggal selesai tetap sama

        // format YYYY-MM-DD
        const yyyy = tanggalSelesai.getFullYear();
        const mm = String(tanggalSelesai.getMonth() + 1).padStart(2, '0'); // bulan 0-11
        const dd = String(tanggalSelesai.getDate()).padStart(2, '0');
        tanggalSelesaiInput.value = `${yyyy}-${mm}-${dd}`;

        document.getElementById('idServicesThatYouChoose').innerText = jenisLayanan;
        document.getElementById('subtotal').innerText = "Rp0,-";
        document.getElementById('totalHarga').innerText = "Rp0,-";
    }

    function JustHitungTotal(inputValue){
        // Ambil select layanan
        const selectLayanan = document.getElementById('selectLayanan');
        const selectedOption = selectLayanan.options[selectLayanan.selectedIndex];

        if(!selectedOption || selectedOption.value === "") {
            // Jika belum pilih layanan, subtotal tetap 0
            document.getElementById('subtotal').innerText = "Rp0,-";
            document.getElementById('totalHarga').innerText = "Rp0,-";
            return;
        }

        const harga = parseFloat(selectedOption.getAttribute('data-harga')); // harga per Kg atau per Pcs
        const jenis = selectedOption.getAttribute('data-jenis'); // 'kiloan' atau 'pcs'

        // Ambil berat dan qty
        let berat = parseFloat(document.getElementById('id_berat').value) || 0;
        let qty = parseFloat(document.getElementById('id_qty').value) || 0;

        // Hitung subtotal sesuai jenis
        let subtotal = 0;
        if(jenis == 'kiloan'){
            subtotal = harga * berat;
        } else {
            subtotal = harga * qty;
        }

        // Tampilkan di Ringkasan Pembayaran
        const formatRp = new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0  }).format(subtotal);
        document.getElementById('subtotal').innerText = formatRp + '.-';
        document.getElementById('totalHarga').innerText = formatRp + '.-';
        document.getElementById('id_total').value = subtotal;
        // Tampilkan juga nama layanan yang dipilih
        let jumlah = jenis == 'kiloan'? berat : qty;
        let satuan = jenis == 'kiloan'? 'Kg' : 'Pcs';
        document.getElementById('idServicesThatYouChoose').innerText = selectedOption.getAttribute('data-layanan') + ' (' + jumlah + ' ' + satuan + ')';
    }

    function HitungKembalian(totalBayar) {
        // Ambil total dari hidden input
        let total = parseFloat(document.getElementById('id_total').value) || 0;

        // Bersihkan input (hapus titik dan karakter selain angka)
        let bayarBersih = totalBayar.replace(/[^0-9]/g, '');
        let bayar = parseFloat(bayarBersih) || 0;

        // Hitung kembalian
        let kembalian = (bayar - total) >= 0 ? (bayar - total) : 0;
        console.log(bayar, total, kembalian);

        // Jika kembalian negatif, tetap tampil angka minus
        // Format angka ke Rupiah
        const formatRp = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(kembalian);

        // Tampilkan ke input kembalian
        document.getElementById('id_kembalian').value = formatRp;

        // Kembalikan format input total bayar sebagai Rp
        const formatBayar = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(bayar);

        document.getElementById('id_totalBayar').value = formatBayar;
    }
</script>
<script>
    function ValidateCreateOrderEdit() {
    let pelanggan = document.getElementById('selectPelanggan_edit').value;
    let layanan = document.getElementById('selectLayanan_edit').value;
    let berat = document.getElementById('id_berat_edit').value;
    let qty = document.getElementById('id_qty_edit').value;

    let total = document.getElementById('id_total_edit').value || "0";

    let totalBayarRaw = document.getElementById('id_totalBayar_edit').value;
    let totalBayarClean = totalBayarRaw.replace(/[^0-9]/g, '');
    let totalBayar = parseInt(totalBayarClean) || 0;

    let totalInt = parseInt(total) || 0;

    if (pelanggan === "") {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap pilih pelanggan!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (layanan === "") {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap pilih layanan!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if ((berat == "" || berat == 0) && (qty == "" || qty == 0)) {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap isi berat atau qty!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (totalInt <= 0) {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Total harga belum dihitung!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (totalBayarRaw === "") {
        return Swal.fire({
            icon: "warning",
            confirmButtonColor: "#6D28D9",
            title: "Peringatan",
            text: "Harap isi total bayar!",
            timer: 2000,
            timerProgressBar: true
        });
    }else if (totalBayar < totalInt) {
        return Swal.fire({
            icon: "error",
            confirmButtonColor: "#6D28D9",
            title: "Pembayaran Kurang!",
            text: "Total bayar masih kurang dari total harga!",
            timer: 2500,
            timerProgressBar: true
        });
    } else {
        document.getElementById('idEditFormOrders').submit();
    }
}
</script>
<script>
    function ChooseSatuanEdit(selectElementEdit){
        // ambil option yang dipilih
        const selectedOptionEdit = selectElementEdit.options[selectElementEdit.selectedIndex];
        const jenisLayananEdit = selectedOptionEdit.getAttribute('data-layanan-edit');
        const jenisSatuanEdit = selectedOptionEdit.getAttribute('data-jenis-edit'); // 'kiloan' atau 'pcs'
        const durasiEdit = parseFloat(selectedOptionEdit.getAttribute('data-durasi-edit')); // dalam jam

        if(jenisSatuanEdit == 'kiloan'){
            document.getElementById('id_berat_edit').removeAttribute('readonly');
            document.getElementById('id_berat_edit').value = 0;
            document.getElementById('id_qty_edit').setAttribute('readonly', true);
            document.getElementById('id_qty_edit').value = 0;
        }else{
            document.getElementById('id_berat_edit').setAttribute('readonly', true);
            document.getElementById('id_berat_edit').value = 0;
            document.getElementById('id_qty_edit').removeAttribute('readonly');
            document.getElementById('id_qty_edit').value = 0;
        }

        // Hitung tanggal selesai
        const tanggalMasukInputEdit = document.getElementById('tanggalMasuk_edit');
        const tanggalSelesaiInputEdit = document.getElementById('tanggalSelesai_edit');

        const tanggalMasukEdit = new Date(tanggalMasukInputEdit.value); // ambil tanggal masuk
        let tanggalSelesaiEdit = new Date(tanggalMasukEdit); // clone tanggal masuk

        if(durasiEdit >= 24){
            // durasiEdit lebih dari 1 hari, hitung jumlah hari, genapi ke atas
            const hariEdit = Math.ceil(durasiEdit / 24);
            tanggalSelesaiEdit.setDate(tanggalSelesaiEdit.getDate() + hariEdit);
        }
        // durasiEdit < 24 jam, tanggal selesai tetap sama

        // format YYYY-MM-DD
        const yyyy = tanggalSelesaiEdit.getFullYear();
        const mm = String(tanggalSelesaiEdit.getMonth() + 1).padStart(2, '0'); // bulan 0-11
        const dd = String(tanggalSelesaiEdit.getDate()).padStart(2, '0');
        tanggalSelesaiInputEdit.value = `${yyyy}-${mm}-${dd}`;

        document.getElementById('idServicesThatYouChoose_edit').innerText = jenisLayananEdit;
        document.getElementById('subtotal_edit').innerText = "Rp0,-";
        document.getElementById('totalHarga_edit').innerText = "Rp0,-";
        document.getElementById('id_totalBayar_edit').value = "0";
        document.getElementById('id_kembalian_edit').value = "0";
    }

    function JustHitungTotalEdit(inputValue){
        // Ambil select layanan
        const selectLayananEdit = document.getElementById('selectLayanan_edit');
        const selectedOptionEdit = selectLayananEdit.options[selectLayananEdit.selectedIndex];

        if(!selectedOptionEdit || selectedOptionEdit.value === "") {
            // Jika belum pilih layanan, subtotal tetap 0
            document.getElementById('subtotal_edit').innerText = "Rp0,-";
            document.getElementById('totalHarga_edit').innerText = "Rp0,-";
            return;
        }

        const hargaEdit = parseFloat(selectedOptionEdit.getAttribute('data-harga-edit')); // harga per Kg atau per Pcs
        const jenisEdit = selectedOptionEdit.getAttribute('data-jenis-edit'); // 'kiloan' atau 'pcs'

        // Ambil berat dan qty
        let beratEdit = parseFloat(document.getElementById('id_berat_edit').value) || 0;
        let qtyEdit = parseFloat(document.getElementById('id_qty_edit').value) || 0;

        // Hitung subtotal sesuai jenis
        let subtotalEdit = 0;
        if(jenisEdit == 'kiloan'){
            subtotalEdit = hargaEdit * beratEdit;
        } else {
            subtotalEdit = hargaEdit * qtyEdit;
        }

        // Tampilkan di Ringkasan Pembayaran
        const formatRpEdit = new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0  }).format(subtotalEdit);
        document.getElementById('subtotal_edit').innerText = formatRpEdit + '.-';
        document.getElementById('totalHarga_edit').innerText = formatRpEdit + '.-';
        document.getElementById('id_total_edit').value = subtotalEdit;
        // Tampilkan juga nama layanan yang dipilih
        let jumlahEdit = jenisEdit == 'kiloan'? beratEdit : qtyEdit;
        let satuanEdit = jenisEdit == 'kiloan'? 'Kg' : 'Pcs';
        document.getElementById('idServicesThatYouChoose_edit').innerText = selectedOptionEdit.getAttribute('data-layanan-edit') + ' (' + jumlahEdit + ' ' + satuanEdit + ')';
        HitungKembalianEdit();
    }

    function HitungKembalianEdit() {
        // Ambil total dari hidden input
        let totalEdit = parseFloat(document.getElementById('id_total_edit').value) || 0;
        let bitch = document.getElementById('id_totalBayar_edit').value;
        // Bersihkan input (hapus titik dan karakter selain angka)
        let bayarBersihEdit = bitch.replace(/[^0-9]/g, '');
        let bayarEdit = parseFloat(bayarBersihEdit) || 0;

        // Hitung kembalian
        let kembalianEdit = (bayarEdit - totalEdit) >= 0 ? (bayarEdit - totalEdit) : 0;
        console.log(bayarEdit, totalEdit, kembalianEdit);

        // Jika kembalian negatif, tetap tampil angka minus
        // Format angka ke Rupiah
        const formatRpEdit = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(kembalianEdit);

        // Tampilkan ke input kembalian
        document.getElementById('id_kembalian_edit').value = formatRpEdit;

        // Kembalikan format input total bayar sebagai Rp
        const formatBayarEdit = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(bayarEdit);

        document.getElementById('id_totalBayar_edit').value = formatBayarEdit;
    }
</script>
<script>
    function onclickCancelOrders(){
         Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Order akan dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6D28D9',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelFormOrders').submit();
            }
        });
    }

    function onclickChangeOrders(){
         Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Status Order Ini diubah!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6D28D9',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('idChangeStatusOrder').submit();
            }
        });
    }
</script>
<script>
    function ChangeThisStatusOrder(status){
        document.getElementById('id_change_status_order').value = status;
    }
</script>
<script>
function printOrder(idOrder) {
    Swal.fire({
        title: 'Print Struk?',
        text: "Apakah Anda yakin ingin mencetak struk?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6D28D9',
        confirmButtonText: 'Ya, Cetak!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            // 1. Buka tab baru ke controller print struk
            let newTab = window.open(`/orders/print-struk/${idOrder}`, '_blank');

            // 2. Refresh halaman saat tab baru selesai dibuka
            setTimeout(() => {
                window.location.reload();
            }, 800);
        }
    });
}
</script>
@endsection
