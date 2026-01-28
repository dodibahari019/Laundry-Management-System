@extends('layouts.frame')
@section('Title', 'Laporan')
@section('CssSection')
@endsection
@section('HeaderTitle', 'Laporan & Analisis')
@section('Description', 'Kelola dan cetak berbagai jenis laporan laundry')

@section('MainContentArea')
    <!-- Filter & Report Selection -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Jenis Laporan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                <select id="reportType"
                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="transaksi">Laporan Transaksi</option>
                    <option value="pendapatan">Laporan Pendapatan</option>
                    <option value="pelanggan">Laporan Pelanggan</option>
                    <option value="layanan">Laporan Layanan</option>
                    <option value="pengeluaran">Laporan Pengeluaran</option>
                    <option value="keuangan">Laporan Keuangan</option>
                </select>
            </div>

            <!-- Periode -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <select onchange="setDateRange()" id="periodType"
                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                    <option value="custom">Kustom</option>
                </select>
            </div>

            <!-- Tanggal Mulai -->
            <div id="startDateWrapper">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" id="startDate"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>

            <!-- Tanggal Akhir -->
            <div id="endDateWrapper">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" id="endDate"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <button onclick="TampilkanLaporan()"
                    class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>Tampilkan Laporan</span>
                </button>
                <button onclick="resetFilter()"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    <span>Reset</span>
                </button>
            </div>

            <div class="flex space-x-3">
                <button onclick="ExportLaporanToPdf()"
                    class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Export PDF</span>
                </button>
                <button onclick="exportExcel()"
                    class="px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span>Export Excel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        @php
            function shortNum($num)
            {
                $units = ['', 'K', 'JT', 'M', 'T', 'P', 'E', 'Z', 'Y'];
                $i = 0;
                while ($num >= 1000 && $i < count($units) - 1) {
                    $num /= 1000;
                    $i++;
                }
                $formatted = rtrim(rtrim(number_format(
                    $num,
                    1,
                    '.',
                    ''
                ), '0'), '.');
                return $formatted . $units[$i];
        } @endphp <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 mb-1">Total Transaksi</p>
            <h3 id="cardTotalTransaksi" class="text-2xl font-bold text-gray-900">{{ shortNum($totalTransaksi) }}</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
            <h3 id="cardTotalPendapatan" class="text-2xl font-bold text-gray-900">Rp {{ shortNum($totalPendapatan) }}
            </h3>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 mb-1">Total Pelanggan</p>
            <h3 id="cardTotalPelanggan" class="text-2xl font-bold text-gray-900">{{ shortNum($totalPelanggan) }}</h3>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 mb-1">Rata-rata/Transaksi</p>
            <h3 id="cardRataRata" class="text-2xl font-bold text-gray-900">Rp {{ shortNum($rataRata) }}</h3>
        </div>
    </div>

    <!-- Report Table -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 id="showThisReportTypeId" class="text-xl font-bold text-gray-900">Laporan Transaksi</h2>
                <p id="rangeTanggal" class="text-sm text-gray-500 mt-1">Periode:
                    {{ \Carbon\Carbon::parse($currentlyDate)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($currentlyDate)->format('d M Y') }}
                </p>
            </div>
        </div>

        @include('reports.table.table')
    </div>

@endsection
@section('JavascriptSection')
    <script>
        // Fungsi Format Tanggal
        function formatTanggal(tanggal) {
            if (!tanggal) return '-';
            const bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
            let dateObj = new Date(tanggal);
            if (isNaN(dateObj)) return tanggal;
            let hari = dateObj.getDate();
            let bulanText = bulan[dateObj.getMonth()];
            let tahun = dateObj.getFullYear();
            return `${hari} ${bulanText} ${tahun}`;
        }

        function formatTanggalWaktu(tanggal) {
            if (!tanggal) return '-';
            const bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
            let dateObj = new Date(tanggal);
            if (isNaN(dateObj)) return tanggal;
            let hari = dateObj.getDate();
            let bulanText = bulan[dateObj.getMonth()];
            let tahun = dateObj.getFullYear();
            let jam = dateObj.getHours().toString().padStart(2, '0');
            let menit = dateObj.getMinutes().toString().padStart(2, '0');
            return `${hari} ${bulanText} ${tahun} ${jam}:${menit}`;
        }

        function formatBerat(value) {
            let num = parseFloat(value);
            let str = num.toFixed(2);
            str = str.replace(/\.?0+$/, '');
            str = str.replace('.', ',');
            return str;
        }

        // Set Date Range
        function setDateRange() {
            const periodType = document.getElementById('periodType');
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');
            const startWrap = document.getElementById('startDateWrapper');
            const endWrap = document.getElementById('endDateWrapper');
            const today = new Date();
            let start, end;

            if (periodType.value === 'today') {
                start = end = today;
            } else if (periodType.value === 'week') {
                start = new Date(today);
                start.setDate(today.getDate() - today.getDay() + 1);
                end = new Date(start);
                end.setDate(start.getDate() + 6);
            } else if (periodType.value === 'month') {
                start = new Date(today.getFullYear(), today.getMonth(), 1);
                end = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            } else if (periodType.value === 'year') {
                start = new Date(today.getFullYear(), 0, 1);
                end = new Date(today.getFullYear(), 11, 31);
            } else {
                startWrap.style.display = "block";
                endWrap.style.display = "block";
                return;
            }

            startDate.value = start.toISOString().split('T')[0];
            endDate.value = end.toISOString().split('T')[0];
            startWrap.style.display = "none";
            endWrap.style.display = "none";
        }

        // Get Colspan
        function getColspan(jenis) {
            if (jenis === "transaksi") return 12;
            if (jenis === "pendapatan") return 5;
            if (jenis === "pelanggan") return 6;
            if (jenis === "layanan") return 8;
            if (jenis === "pengeluaran") return 7;
            if (jenis === "keuangan") return 6;
            return 1;
        }

        // Render Table Header
        function renderTableHeader(jenis) {
            let thead = "";

            if (jenis === "transaksi") {
                thead = `
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Kode Order</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pelanggan</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Layanan</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Berat/Qty</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Estimasi Selesai</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Metode Pembayaran</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Tanggal Bayar</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Dibayar</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Kembalian</th>
                    </tr>
                `;
            } else if (jenis === "pendapatan") {
                thead = `
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Tanggal Transaksi</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Jumlah Transaksi</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total Pendapatan</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Rata-Rata per Transaksi</th>
                    </tr>
                `;
            } else if (jenis === "pelanggan") {
                thead = `
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pelanggan</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Jumlah Transaksi</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total Belanja</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Rata-Rata Belanja</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Transaksi Terakhir</th>
                    </tr>
                `;
            } else if (jenis === "layanan") {
                thead = `
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Nama Layanan</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Jenis</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Harga</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Jumlah Transaksi</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total Berat/Qty</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total Pendapatan</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Popularitas</th>
                    </tr>
                `;
            } else if (jenis === "pengeluaran") {
                thead = `
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Nama Pengeluaran</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Deskripsi</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Jumlah</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Status</th>
                    </tr>
                `;
            } else if (jenis === "keuangan") {
                thead = `
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pendapatan</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pengeluaran</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Laba Bersih</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Persentase</th>
                    </tr>
                `;
            }

            $("#idHeaderTableLaporan").html(thead);
        }

        // Render Table Body
        function renderTableBody(jenis, data) {
            let rows = "";

            if (!data || data.length === 0) {
                const colspan = getColspan(jenis);
                rows = `<tr><td colspan="${colspan}" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
                $("#idBodyTableLaporan").html(rows);
                return;
            }

            data.forEach((x, i) => {
                let nomor = i + 1;

                if (jenis === "transaksi") {
                    let jenisColor = x.jenis == 'kiloan' ? 'bg-blue-100 text-blue-700' :
                        'bg-purple-100 text-purple-700';
                    let beratQtyRaw = x.jenis == 'kiloan' ? x.berat : x.jumlah;
                    let satuan = x.jenis == 'kiloan' ? 'Kg' : 'Pcs';
                    let beratQty = formatBerat(beratQtyRaw);

                    let statusColor = 'bg-yellow-100 text-yellow-700';
                    if (x.status_order == 'diproses') statusColor = 'bg-blue-100 text-blue-700';
                    else if (x.status_order == 'dicuci') statusColor = 'bg-orange-100 text-orange-700';
                    else if (x.status_order == 'disetrika') statusColor = 'bg-purple-100 text-purple-700';
                    else if (x.status_order == 'ready') statusColor = 'bg-green-100 text-green-700';
                    else if (x.status_order == 'diambil') statusColor = 'bg-gray-100 text-gray-700';
                    else if (x.status_order == 'dibatalkan') statusColor = 'bg-red-100 text-red-700';

                    let icon = x.status_order == 'diambil' ?
                        `<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>` :
                        `<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>`;

                    let estimasi = x.status_order == 'diambil' ? 'Selesai' : formatTanggal(x.tanggal_selesai);

                    let colorMethod = x.metode == 'qris' ? 'bg-purple-100 text-purple-700' :
                        x.metode == 'transfer' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700';

                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6"><span class="font-semibold text-gray-900">${nomor}</span></td>
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
                            <td class="py-4 px-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">${x.nama_layanan}</p>
                                    <p class="text-xs text-gray-500">${x.jenis}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="${jenisColor} px-3 py-1 rounded-full text-xs font-bold">${beratQty} ${satuan}</span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-bold text-gray-900">Rp ${Number(x.total).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex justify-center">
                                    <span class="${statusColor} px-3 py-1 rounded-full text-xs font-bold">${x.status_order}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    ${icon}
                                    <span class="text-sm text-gray-900">${estimasi}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="${colorMethod} px-3 py-1 rounded-full text-xs font-bold">${x.metode}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-900">${formatTanggal(x.tanggal_masuk)}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-bold text-gray-900">Rp ${Number(x.jumlahBayar).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-bold text-gray-900">Rp ${Number(x.kembalian).toLocaleString('id-ID')}</p>
                            </td>
                        </tr>
                    `;
                } else if (jenis === "pendapatan") {
                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6"><span class="font-semibold text-gray-900">${nomor}</span></td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-900">${formatTanggal(x.tanggal_transaksi)}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-semibold text-gray-900">${Number(x.jumlah_transaksi).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-semibold text-gray-900">Rp ${Number(x.total_pendapatan).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-semibold text-gray-900">Rp ${Number(x.rata_rata_per_transaksi).toLocaleString('id-ID')}</p>
                            </td>
                        </tr>
                    `;
                } else if (jenis === "pelanggan") {
                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6"><span class="font-semibold text-gray-900">${nomor}</span></td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-gray-900">${x.nama_pelanggan}</p>
                                    <p class="text-xs text-gray-500">${x.no_hp}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-semibold text-gray-900">${Number(x.jumlah_transaksi).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-semibold text-gray-900">Rp ${Number(x.total_belanja).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <p class="font-semibold text-gray-900">Rp ${Number(x.rata_rata_belanja).toLocaleString('id-ID')}</p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-900">${formatTanggal(x.tanggal_transaksi_terakhir)}</span>
                                </div>
                            </td>
                        </tr>
                    `;
                } else if (jenis === "layanan") {
                    let jenisColor = x.jenis == 'kiloan' ? 'bg-blue-100 text-blue-700' :
                        'bg-purple-100 text-purple-700';
                    let totalBeratQtyRaw = x.jenis == 'kiloan' ? x.total_berat : x.total_qty;
                    let satuan = x.jenis == 'kiloan' ? 'Kg' : 'Pcs';
                    let totalBeratQty = formatBerat(totalBeratQtyRaw);

                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6"><span class="font-semibold text-gray-900">${nomor}</span></td>
                            <td class="py-4 px-6"><p class="font-semibold text-gray-900">${x.nama_layanan}</p></td>
                            <td class="py-4 px-6"><span class="${jenisColor} px-3 py-1 rounded-full text-xs font-bold">${x.jenis}</span></td>
                            <td class="py-4 px-6 text-right"><p class="font-semibold text-gray-900">Rp ${Number(x.harga_layanan).toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6 text-right"><p class="font-semibold text-gray-900">${Number(x.jumlah_transaksi).toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6 text-center"><span class="${jenisColor} px-3 py-1 rounded-full text-xs font-bold">${totalBeratQty} ${satuan}</span></td>
                            <td class="py-4 px-6 text-right"><p class="font-semibold text-gray-900">Rp ${Number(x.total_pendapatan).toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6 text-right"><p class="font-semibold text-gray-900">${Number(x.popularitas).toFixed(1)}%</p></td>
                        </tr>
                    `;
                } else if (jenis === "pengeluaran") {
                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6"><span class="font-semibold text-gray-900">${nomor}</span></td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-900">${formatTanggal(x.tanggal_pengeluaran)}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6"><p class="font-semibold text-gray-900">${x.nama_pengeluaran}</p></td>
                            <td class="py-4 px-6"><span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold">${x.kategori_pengeluaran || x.kategori || '-'}</span></td>
                            <td class="py-4 px-6"><p class="text-sm text-gray-600">${x.deskripsi || '-'}</p></td>
                            <td class="py-4 px-6 text-right"><p class="font-bold text-red-600">Rp ${Number(x.jumlah).toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6">
                                <div class="flex justify-center">
                                    <span class="${x.status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'} px-3 py-1 rounded-full text-xs font-bold">${x.status || 'aktif'}</span>
                                </div>
                            </td>
                        </tr>
                    `;
                } else if (jenis === "keuangan") {
                    let labaBersih = Number(x.total_pendapatan) - Number(x.total_pengeluaran);
                    let persenLaba = Number(x.total_pendapatan) > 0 ? ((labaBersih / Number(x.total_pendapatan)) *
                        100) : 0;
                    let labaColor = labaBersih >= 0 ? 'text-green-600' : 'text-red-600';
                    let persenColor = labaBersih >= 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';

                    rows += `
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6"><span class="font-semibold text-gray-900">${nomor}</span></td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-900">${formatTanggal(x.tanggal)}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right"><p class="font-bold text-green-600">Rp ${Number(x.total_pendapatan).toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6 text-right"><p class="font-bold text-red-600">Rp ${Number(x.total_pengeluaran).toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6 text-right"><p class="font-bold ${labaColor}">Rp ${labaBersih.toLocaleString('id-ID')}</p></td>
                            <td class="py-4 px-6 text-center"><span class="${persenColor} px-3 py-1 rounded-full text-xs font-bold">${persenLaba.toFixed(1)}%</span></td>
                        </tr>
                    `;
                }
            });

            $("#idBodyTableLaporan").html(rows);
        }

        function shortNumJavascript(num) {
            const units = ['', 'K', 'JT', 'M', 'T', 'P', 'E', 'Z', 'Y'];
            let i = 0;
            while (num >= 1000 && i < units.length - 1) {
                num /= 1000;
                i++;
            }
            let formatted = num.toFixed(1).replace(/\.0$/, '');
            return formatted + units[i];
        }

        function TampilkanLaporan() {
            let jenis = $("#reportType").val();
            let period = $("#periodType").val();
            let start = $("#startDate").val();
            let end = $("#endDate").val();
            let reportTypeView = "Laporan Transaksi";
            if (jenis == 'pendapatan') reportTypeView = "Laporan Pendapatan";
            else if (jenis == 'pelanggan') reportTypeView = "Laporan Pelanggan";
            else if (jenis == 'layanan') reportTypeView = "Laporan Layanan";
            else if (jenis == 'pengeluaran') reportTypeView = "Laporan Pengeluaran";
            else if (jenis == 'keuangan') reportTypeView = "Laporan Keuangan";

            $.ajax({
                url: "/laporan/generateReport",
                type: "GET",
                data: {
                    jenisLaporan: jenis,
                    periodType: period,
                    startDate: start,
                    endDate: end
                },
                success: function (res) {
                    renderTableHeader(jenis);
                    renderTableBody(jenis, res.data);

                    $("#cardTotalTransaksi").text(shortNumJavascript(res.allTransaksi || 0));
                    $("#cardTotalPendapatan").text("Rp " + shortNumJavascript(res.allPendapatan || 0));
                    $("#cardTotalPelanggan").text(shortNumJavascript(res.allPelanggan || 0));
                    $("#cardRataRata").text("Rp " + shortNumJavascript(res.allRataRata || 0));

                    document.getElementById('showThisReportTypeId').innerText = reportTypeView;

                    if (res.tanggal_awal && res.tanggal_akhir) {
                        $("#rangeTanggal").text(
                            `Periode: ${formatTanggal(res.tanggal_awal)} - ${formatTanggal(res.tanggal_akhir)}`);
                    } else {
                        $("#rangeTanggal").text("");
                    }
                },
                error: function (err) {
                    console.error("Error fetching report:", err);
                    Swal.fire('Error', 'Gagal memuat laporan', 'error');
                }
            });
        }

        function ExportLaporanToPdf() {
            let jenis = $("#reportType").val();
            let period = $("#periodType").val();
            let start = $("#startDate").val();
            let end = $("#endDate").val();

            // Get report type label
            let reportLabel = {
                'transaksi': 'Transaksi',
                'pendapatan': 'Pendapatan',
                'pelanggan': 'Pelanggan',
                'layanan': 'Layanan',
                'pengeluaran': 'Pengeluaran',
                'keuangan': 'Keuangan'
            }[jenis] || 'Transaksi';

            Swal.fire({
                title: 'Export ke PDF?',
                html: `Laporan <strong>${reportLabel}</strong> akan diekspor ke format PDF`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#6B7280',
                confirmButtonText: '<i class="fas fa-file-pdf"></i> Ya, Export PDF!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading with different message
                    Swal.fire({
                        title: 'Membuat PDF...',
                        html: `Sedang menghasilkan file PDF untuk laporan ${reportLabel}`,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch(`/laporan/exportPDF?jenisLaporan=${jenis}&periodType=${period}&startDate=${start}&endDate=${end}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.blob();
                        })
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = `Laporan_${reportLabel}_${Date.now()}.pdf`;
                            document.body.appendChild(a);
                            a.click();
                            a.remove();
                            window.URL.revokeObjectURL(url);

                            // Success notification with file info
                            Swal.fire({
                                icon: 'success',
                                title: 'PDF Berhasil Diunduh!',
                                html: `
                            <div class="text-left">
                                <p class="mb-2">✓ Laporan ${reportLabel} telah diunduh</p>
                                <p class="text-sm text-gray-600">Format: PDF</p>
                                <p class="text-sm text-gray-600">Periksa folder <strong>Downloads</strong> Anda</p>
                            </div>
                        `,
                                confirmButtonColor: '#DC2626',
                                confirmButtonText: 'OK'
                            });
                        })
                        .catch(err => {
                            console.error('Error:', err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Export PDF',
                                text: 'Terjadi kesalahan saat menghasilkan file PDF. Silakan coba lagi.',
                                confirmButtonColor: '#DC2626'
                            });
                        });
                }
            });
        }

        function exportExcel() {
            let jenis = $("#reportType").val();
            let period = $("#periodType").val();
            let start = $("#startDate").val();
            let end = $("#endDate").val();

            // Get report type label
            let reportLabel = {
                'transaksi': 'Transaksi',
                'pendapatan': 'Pendapatan',
                'pelanggan': 'Pelanggan',
                'layanan': 'Layanan',
                'pengeluaran': 'Pengeluaran',
                'keuangan': 'Keuangan'
            }[jenis] || 'Transaksi';

            Swal.fire({
                title: 'Export ke Excel?',
                html: `Laporan <strong>${reportLabel}</strong> akan diekspor ke format Excel (.xlsx)`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10B981',
                cancelButtonColor: '#6B7280',
                confirmButtonText: '<i class="fas fa-file-excel"></i> Ya, Export Excel!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Membuat Excel...',
                        html: `Sedang menghasilkan file Excel untuk laporan ${reportLabel}`,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/laporan/exportExcel';

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfInput);

                    const jenisInput = document.createElement('input');
                    jenisInput.type = 'hidden';
                    jenisInput.name = 'jenisLaporan';
                    jenisInput.value = jenis;
                    form.appendChild(jenisInput);

                    const periodInput = document.createElement('input');
                    periodInput.type = 'hidden';
                    periodInput.name = 'periodType';
                    periodInput.value = period;
                    form.appendChild(periodInput);

                    const startInput = document.createElement('input');
                    startInput.type = 'hidden';
                    startInput.name = 'startDate';
                    startInput.value = start;
                    form.appendChild(startInput);

                    const endInput = document.createElement('input');
                    endInput.type = 'hidden';
                    endInput.name = 'endDate';
                    endInput.value = end;
                    form.appendChild(endInput);

                    document.body.appendChild(form);
                    form.submit();
                    document.body.removeChild(form);

                    // Success notification
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Excel Berhasil Diunduh!',
                            html: `
                            <div class="text-left">
                                <p class="mb-2">✓ Laporan ${reportLabel} telah diunduh</p>
                                <p class="text-sm text-gray-600">Format: Excel (.xlsx)</p>
                                <p class="text-sm text-gray-600">Periksa folder <strong>Downloads</strong> Anda</p>
                                <p class="text-sm text-gray-500 mt-2">💡 File dapat dibuka dengan Microsoft Excel atau Google Sheets</p>
                            </div>
                        `,
                            confirmButtonColor: '#10B981',
                            confirmButtonText: 'OK'
                        });
                    }, 1000);
                }
            });
        }
        $(document).ready(function () {
            setDateRange();
            TampilkanLaporan();
        });
    </script>
@endsection