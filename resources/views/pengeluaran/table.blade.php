<table id="pengeluaranTable" class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">NO</th>
            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">TANGGAL</th>
            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">NAMA PENGELUARAN</th>
            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">KATEGORI</th>
            <th class="py-4 px-6 text-right text-sm font-semibold text-gray-700">JUMLAH</th>
            <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">AKSI</th>
        </tr>
    </thead>
    <tbody id="idBodyTablePengeluaran">
        @forelse($pengeluaran as $index => $item)
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition" data-kategori="{{ $item->kategori }}">

                {{-- NO --}}
                <td class="py-3 px-4 font-medium text-gray-900">
                    {{ $index + 1 }}
                </td>

                {{-- TANGGAL --}}
                <td class="py-3 px-4 text-sm text-gray-600 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d/m/Y') }}
                </td>

                {{-- NAMA --}}
                <td class="py-3 px-4">
                    <p class="font-semibold text-gray-900 leading-5">
                        {{ $item->nama_pengeluaran }}
                    </p>
                </td>

                {{-- KATEGORI --}}
                <td class="py-3 px-4">
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

                    <span
                        class="inline-flex items-center {{ $colorClass }} px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">
                        {{ $item->kategori_nama }}
                    </span>
                </td>

                {{-- JUMLAH --}}
                <td class="py-3 px-4 text-right font-bold text-gray-900 whitespace-nowrap">
                    {{ $item->jumlah_format }}
                </td>

                {{-- AKSI --}}
                <td class="py-3 px-4">
                    <div class="flex items-center justify-center gap-3">
                        <button data-url="/pengeluaran/{{ $item->id_pengeluaran }}/edit"
                            class="modal-crud text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg p-2 transition"
                            title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </button>

                        <button onclick="confirmDelete('{{ $item->id_pengeluaran }}')"
                            class="text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg p-2 transition" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>

                        <!-- Hidden Form untuk Delete -->
                        <form id="deleteForm{{ $item->id_pengeluaran }}"
                            action="{{ route('pengeluaran.destroy', $item->id_pengeluaran) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center py-12">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">Belum ada data pengeluaran</p>
                        <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah" untuk menambahkan pengeluaran baru</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
    @if($pengeluaran->count() > 0)
        <tfoot class="bg-gray-50 border-t-2 border-gray-300">
            <tr>
                <td colspan="4" class="py-4 px-6 text-right">
                    <span class="text-sm font-bold text-gray-900">Total Pengeluaran:</span>
                </td>
                <td colspan="3" class="py-4 px-6 text-right">
                    <span class="text-lg font-bold text-red-600">
                        Rp {{ number_format($pengeluaran->sum('jumlah'), 0, ',', '.') }}
                    </span>
                </td>
            </tr>
        </tfoot>
    @endif
</table>