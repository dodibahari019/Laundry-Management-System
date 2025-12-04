<table class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">ID Order</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pelanggan</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Layanan</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Berat/Qty</th>
            <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Status</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Estimasi</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        <!-- Row 1 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">1</span>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-purple-600">#OR-001247</p>
                    <p class="text-xs text-gray-500">29 Nov 2025, 14:30</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-gray-900">Budi Santoso</p>
                    <p class="text-xs text-gray-500">0812-3456-7890</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="text-sm font-medium text-gray-900">Cuci + Setrika</p>
                    <p class="text-xs text-gray-500">Kiloan</p>
                </div>
            </td>
            <td class="py-4 px-6 text-center">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">3 kg</span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp 24.000</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex justify-center">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Ready</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm text-gray-900">01 Des 2025</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="openDetailOrder('OR-001247')" class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="openEditOrder('OR-001247')" class="text-green-600 hover:text-green-800 p-1" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('OR-001247')" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <!-- Row 2 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">2</span>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-purple-600">#OR-001246</p>
                    <p class="text-xs text-gray-500">29 Nov 2025, 13:15</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-gray-900">Siti Aminah</p>
                    <p class="text-xs text-gray-500">0813-9876-5432</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="text-sm font-medium text-gray-900">Express 6 Jam</p>
                    <p class="text-xs text-gray-500">Kiloan</p>
                </div>
            </td>
            <td class="py-4 px-6 text-center">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">2 kg</span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp 30.000</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex justify-center">
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Disetrika</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm text-gray-900 font-semibold text-orange-600">29 Nov 2025</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="openDetailOrder('OR-001246')" class="text-blue-600 hover:text-blue-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="openEditOrder('OR-001246')" class="text-green-600 hover:text-green-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('OR-001246')" class="text-red-600 hover:text-red-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <!-- Row 3 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">3</span>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-purple-600">#OR-001245</p>
                    <p class="text-xs text-gray-500">28 Nov 2025, 16:45</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-gray-900">Ahmad Hidayat</p>
                    <p class="text-xs text-gray-500">0856-7890-1234</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="text-sm font-medium text-gray-900">Cuci Jas</p>
                    <p class="text-xs text-gray-500">Satuan</p>
                </div>
            </td>
            <td class="py-4 px-6 text-center">
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">1 pcs</span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp 25.000</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex justify-center">
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">Diambil</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm text-green-600 font-semibold">Selesai</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="openDetailOrder('OR-001245')" class="text-blue-600 hover:text-blue-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="openEditOrder('OR-001245')" class="text-green-600 hover:text-green-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('OR-001245')" class="text-red-600 hover:text-red-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <!-- Row 4 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">4</span>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-purple-600">#OR-001244</p>
                    <p class="text-xs text-gray-500">28 Nov 2025, 11:20</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-gray-900">Dewi Lestari</p>
                    <p class="text-xs text-gray-500">0821-4567-8901</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="text-sm font-medium text-gray-900">Cuci Kering</p>
                    <p class="text-xs text-gray-500">Kiloan</p>
                </div>
            </td>
            <td class="py-4 px-6 text-center">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">5 kg</span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp 25.000</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex justify-center">
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold">Dicuci</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm text-gray-900">30 Nov 2025</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="openDetailOrder('OR-001244')" class="text-blue-600 hover:text-blue-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="openEditOrder('OR-001244')" class="text-green-600 hover:text-green-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('OR-001244')" class="text-red-600 hover:text-red-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <!-- Row 5 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">5</span>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-purple-600">#OR-001243</p>
                    <p class="text-xs text-gray-500">27 Nov 2025, 15:00</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-gray-900">Rudi Hermawan</p>
                    <p class="text-xs text-gray-500">0878-5432-1098</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="text-sm font-medium text-gray-900">Setrika Saja</p>
                    <p class="text-xs text-gray-500">Kiloan</p>
                </div>
            </td>
            <td class="py-4 px-6 text-center">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">4 kg</span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp 16.000</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex justify-center">
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Menunggu</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm text-gray-900">28 Nov 2025</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="openDetailOrder('OR-001243')" class="text-blue-600 hover:text-blue-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    <button onclick="openEditOrder('OR-001243')" class="text-green-600 hover:text-green-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('OR-001243')" class="text-red-600 hover:text-red-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    </tbody>
</table>