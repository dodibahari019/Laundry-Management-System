<table id="idTableLayanan" class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Nama Layanan</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Jenis</th>
            <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Harga</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Durasi</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Status</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody id="idBodyTableLayananLaundry" class="divide-y divide-gray-100">
        <!-- Row 1 -->
        @foreach($dataLayanan as $x)
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">{{ $dataLayanan->firstItem() + $loop->index }}</span>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-3">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $x->nama_layanan }}</p>
                    </div>
                </div>
            </td>
            <td class="py-4 px-6">
                @php
                    $jenisColor = $x->jenis == 'kiloan'
                        ? 'bg-blue-100 text-blue-700'
                        : 'bg-purple-100 text-purple-700';
                @endphp

                <span class="{{ $jenisColor }} px-3 py-1 rounded-full text-xs font-bold">
                    {{ $x->jenis }}
                </span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp {{number_format($x->harga,0,',' , '.')}}</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @php
                        $hari = floor($x->durasi / 24);
                        $jam = $x->durasi % 24;
                    @endphp

                    <span class="text-sm text-gray-900">
                        @if($hari > 0)
                            {{ $hari }} hari
                        @endif
                        @if($jam > 0)
                            {{ $jam }} jam
                        @endif
                    </span>
                </div>
            </td>
            <td class="py-4 px-6">
                @php
                    $statusColor = $x->status == 'Aktif'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700';
                @endphp

                <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold">
                    {{ $x->status }}
                </span>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button data-url="/layanan/{{ $x->id_layanan }}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <form id="deleteForm{{ $x->id_layanan }}" action="/layanan/{{ $x->id_layanan }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button onclick="confirmDelete('{{ $x->id_layanan }}', this)" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
