<table class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">ID Pelanggan</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Nama</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No HP</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Email</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Alamat</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Aksi</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-100">
        
        <!-- Contoh Data 1 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6 font-semibold">1</td>
            <td class="py-4 px-6 font-semibold text-gray-900">PLG001</td>
            <td class="py-4 px-6 text-gray-900">Andi Saputra</td>
            <td class="py-4 px-6 text-gray-900">08123456789</td>
            <td class="py-4 px-6 text-gray-900">andi@mail.com</td>
            <td class="py-4 px-6 text-gray-900">Jl. Melati No. 12</td>

            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    
                    <!-- Detail -->
                    <button onclick="openDetailModal()" class="text-blue-600 hover:text-blue-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S3.732 16.057 2.458 12z"/>
                        </svg>
                    </button>

                    <!-- Edit -->
                    <button onclick="openEditModal()" class="text-green-600 hover:text-green-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.586 3.586a2 2 0 112.828 2.828L11.828 13H9v-2.828l6.586-6.586z"/>
                        </svg>
                    </button>

                    <!-- Hapus -->
                    <button onclick="confirmDelete()" class="text-red-600 hover:text-red-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 7h14M10 11v6m4-6v6"/>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

        <!-- Contoh Data 2 -->
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6 font-semibold">2</td>
            <td class="py-4 px-6 font-semibold text-gray-900">PLG002</td>
            <td class="py-4 px-6 text-gray-900">Budi Hartono</td>
            <td class="py-4 px-6 text-gray-900">089998887777</td>
            <td class="py-4 px-6 text-gray-900">budi@mail.com</td>
            <td class="py-4 px-6 text-gray-900">Perumahan Griya Sejahtera Blok B3</td>

            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="openDetailModal()" class="text-blue-600 hover:text-blue-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 416 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S3.732 16.057 2.458 12z"/>
                        </svg>
                    </button>

                    <button onclick="openEditModal()" class="text-green-600 hover:text-green-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.586 3.586a2 2 0 112.828 2.828L11.828 13H9v-2.828l6.586-6.586z"/>
                        </svg>
                    </button>

                    <button onclick="confirmDelete()" class="text-red-600 hover:text-red-800 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 7h14M10 11v6m4-6v6"/>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>

    </tbody>
</table>
