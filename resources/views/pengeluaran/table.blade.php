<table id="pengeluaranTable" class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">NO</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">TANGGAL</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">NAMA PENGELUARAN</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">KATEGORI</th>
            <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">JUMLAH</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">AKSI</th>
        </tr>
    </thead>
    <tbody id="idBodyTablePengeluaran" class="divide-y divide-gray-100">
        @if($pengeluaran->count() > 0)
            @foreach($pengeluaran as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-4 px-6">
                        <span class="font-semibold text-gray-900">{{ $pengeluaran->firstItem() + $loop->index }}</span>
                    </td>
                    <td class="py-4 px-6">
                        <span class="text-sm text-gray-600 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <p class="font-semibold text-gray-900">{{ $item->nama_pengeluaran }}</p>
                    </td>
                    <td class="py-4 px-6">
                        @php
                            $badgeColors = [
                                'operasional' => 'bg-blue-100 text-blue-700',
                                'peralatan' => 'bg-purple-100 text-purple-700',
                                'bahan' => 'bg-green-100 text-green-700',
                                'gaji' => 'bg-yellow-100 text-yellow-700',
                                'utilitas' => 'bg-orange-100 text-orange-700',
                                'lainnya' => 'bg-gray-100 text-gray-700',
                            ];
                            $colorClass = $badgeColors[$item->kategori] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="{{ $colorClass }} px-3 py-1 rounded-full text-xs font-bold">
                            {{ $item->kategori_nama }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <p class="font-bold text-gray-900">{{ $item->jumlah_format }}</p>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-center space-x-2">
                            <button data-url="/pengeluaran/{{ $item->id_pengeluaran }}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form id="deleteForm{{ $item->id_pengeluaran }}" action="/pengeluaran/{{ $item->id_pengeluaran }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button onclick="confirmDelete('{{ $item->id_pengeluaran }}')" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr></tr>
                <td colspan="6" class="py-4 px-6 text-center text-gray-500">
                    Tidak ada data pengeluaran.
                </td>
            </tr>
        @endif
    </tbody>
    
    <!-- FOOTER TOTAL - TAMBAHKAN INI -->
    @if($pengeluaran->count() > 0)
        <tfoot id="tableFooter" class="bg-gray-50 border-t-2 border-gray-300">
            <tr>
                <td colspan="4" class="py-4 px-6 text-right">
                    <span class="text-sm font-bold text-gray-900">Total Pengeluaran:</span>
                </td>
                <td colspan="2" class="py-4 px-6 text-right">
                    <span class="text-xl font-bold text-red-600">
                        Rp {{ number_format($pengeluaran->sum('jumlah'), 0, ',', '.') }}
                    </span>
                </td>
            </tr>
        </tfoot>
    @endif
</table>