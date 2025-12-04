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
                <select id="reportType" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="transaksi">Laporan Transaksi</option>
                    <option value="pendapatan">Laporan Pendapatan</option>
                    <option value="pelanggan">Laporan Pelanggan</option>
                    <option value="layanan">Laporan Layanan</option>
                    <option value="keuangan">Laporan Keuangan</option>
                    <option value="inventaris">Laporan Inventaris</option>
                </select>
            </div>

            <!-- Periode -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <select id="periodType" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
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
                <input type="date" id="startDate" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>

            <!-- Tanggal Akhir -->
            <div id="endDateWrapper">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" id="endDate" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <button onclick="generateReport()" class="px-6 py-2.5 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>Tampilkan Laporan</span>
                </button>
                <button onclick="resetFilter()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span>Reset</span>
                </button>
            </div>

            <div class="flex space-x-3">
                <button onclick="exportPDF()" class="px-6 py-2.5 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span>Export PDF</span>
                </button>
                <button onclick="exportExcel()" class="px-6 py-2.5 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export Excel</span>
                </button>
                <button onclick="printReport()" class="px-6 py-2.5 bg-gray-700 text-white rounded-xl font-semibold hover:bg-gray-800 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Print</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">+12%</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">Total Transaksi</p>
            <h3 class="text-2xl font-bold text-gray-900">1,247</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">+8%</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
            <h3 class="text-2xl font-bold text-gray-900">Rp 45.7M</h3>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">+15%</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">Total Pelanggan</p>
            <h3 class="text-2xl font-bold text-gray-900">856</h3>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover-scale">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">-3%</span>
            </div>
            <p class="text-sm text-gray-500 mb-1">Rata-rata/Transaksi</p>
            <h3 class="text-2xl font-bold text-gray-900">Rp 36.6K</h3>
        </div>
    </div>

    <!-- Report Table -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Laporan Transaksi</h2>
                <p class="text-sm text-gray-500 mt-1">Periode: 01 November 2025 - 29 November 2025</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Menampilkan:</span>
                    <select class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <span class="text-sm text-gray-600">data</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">ID Transaksi</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pelanggan</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Layanan</th>
                        <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total</th>
                        <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">1</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001247</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">29 Nov 2025</p>
                                <p class="text-xs text-gray-500">14:30 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Budi Santoso</p>
                                <p class="text-xs text-gray-500">0812-3456-7890</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Cuci + Setrika (3 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 24.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">2</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001246</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">29 Nov 2025</p>
                                <p class="text-xs text-gray-500">13:15 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Siti Aminah</p>
                                <p class="text-xs text-gray-500">0813-9876-5432</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Express 6 Jam (2 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 30.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Proses</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">3</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001245</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">28 Nov 2025</p>
                                <p class="text-xs text-gray-500">16:45 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Ahmad Hidayat</p>
                                <p class="text-xs text-gray-500">0856-7890-1234</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Cuci Jas (1 pcs)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 25.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">4</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001244</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">28 Nov 2025</p>
                                <p class="text-xs text-gray-500">11:20 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Dewi Lestari</p>
                                <p class="text-xs text-gray-500">0821-4567-8901</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Cuci Kering (5 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 25.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 5 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">5</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001243</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">27 Nov 2025</p>
                                <p class="text-xs text-gray-500">15:00 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Rudi Hermawan</p>
                                <p class="text-xs text-gray-500">0878-5432-1098</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Setrika Saja (4 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 16.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Diambil</span>
                        </td>
                        <td class="py-4 px-6">>
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 6 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">6</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001242</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">27 Nov 2025</p>
                                <p class="text-xs text-gray-500">09:30 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Linda Wijaya</p>
                                <p class="text-xs text-gray-500">0819-2345-6789</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Cuci + Setrika (6 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 48.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 7 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">7</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001241</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">26 Nov 2025</p>
                                <p class="text-xs text-gray-500">17:10 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Hendra Kusuma</p>
                                <p class="text-xs text-gray-500">0857-1234-5678</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Express 6 Jam (3 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 45.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 8 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">8</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001240</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">26 Nov 2025</p>
                                <p class="text-xs text-gray-500">12:45 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Rina Susanti</p>
                                <p class="text-xs text-gray-500">0822-9876-5432</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Cuci Kering (8 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 40.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Proses</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 9 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">9</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001239</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">25 Nov 2025</p>
                                <p class="text-xs text-gray-500">10:15 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Agus Prasetyo</p>
                                <p class="text-xs text-gray-500">0838-7654-3210</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Setrika Saja (7 kg)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 28.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 10 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6"><span class="font-semibold text-gray-900">10</span></td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-purple-600">#TRX-001238</span>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="text-sm font-medium text-gray-900">25 Nov 2025</p>
                                <p class="text-xs text-gray-500">08:00 WIB</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <p class="font-semibold text-gray-900">Maya Anggraini</p>
                                <p class="text-xs text-gray-500">0899-1234-5678</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="text-sm text-gray-900">Cuci Jas (2 pcs)</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <p class="font-bold text-gray-900">Rp 50.000</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Dibatalkan</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Summary Footer -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold">1-10</span> dari <span class="font-semibold">1,247</span> transaksi
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <p class="text-sm text-gray-600 mb-1">Total Transaksi</p>
                        <p class="text-2xl font-bold text-gray-900">Rp 331.000</p>
                    </div>
                    <div class="h-12 w-px bg-gray-300"></div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 mb-1">Rata-rata</p>
                        <p class="text-2xl font-bold text-purple-600">Rp 33.100</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex items-center justify-between">
            <div class="flex space-x-2">
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 disabled:opacity-50" disabled>
                    Previous
                </button>
                <button class="px-3 py-2 bg-purple-600 text-white rounded-lg text-sm font-semibold">1</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">2</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">3</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">...</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">125</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">
                    Next
                </button>
            </div>
        </div>
    </div>

@endsection
@section('JavascriptSection')
<script>
    // Show/Hide custom date inputs based on period selection
    const periodType = document.getElementById('periodType');
    const startDateWrapper = document.getElementById('startDateWrapper');
    const endDateWrapper = document.getElementById('endDateWrapper');

    periodType.addEventListener('change', function() {
        if (this.value === 'custom') {
            startDateWrapper.style.display = 'block';
            endDateWrapper.style.display = 'block';
        } else {
            startDateWrapper.style.display = 'none';
            endDateWrapper.style.display = 'none';
        }
    });

    // Initialize: hide date inputs by default
    if (periodType.value !== 'custom') {
        startDateWrapper.style.display = 'none';
        endDateWrapper.style.display = 'none';
    }

    // Generate Report Function
    function generateReport() {
        const reportType = document.getElementById('reportType').value;
        const period = document.getElementById('periodType').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        // Add your logic here to generate report
        console.log('Generating report:', {reportType, period, startDate, endDate});
        
        // Show loading or success message
        alert('Laporan sedang dibuat...');
    }

    // Reset Filter Function
    function resetFilter() {
        document.getElementById('reportType').value = 'transaksi';
        document.getElementById('periodType').value = 'today';
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
        startDateWrapper.style.display = 'none';
        endDateWrapper.style.display = 'none';
    }

    // Export PDF Function
    function exportPDF() {
        const reportType = document.getElementById('reportType').value;
        // Add your PDF export logic here
        console.log('Exporting to PDF:', reportType);
        alert('Mengekspor laporan ke PDF...');
    }

    // Export Excel Function
    function exportExcel() {
        const reportType = document.getElementById('reportType').value;
        // Add your Excel export logic here
        console.log('Exporting to Excel:', reportType);
        alert('Mengekspor laporan ke Excel...');
    }

    // Print Report Function
    function printReport() {
        window.print();
    }

    // Set today's date as default for date inputs
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('startDate').value = today;
    document.getElementById('endDate').value = today;
</script>
@endsection