<table class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Nama</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No HP</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Email</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Alamat</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Aksi</th>
        </tr>
    </thead>

    <tbody id="idBodyTablePelanggan">
        @forelse ($dataPelanggan as $index => $p)
        <tr class="border-b">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">{{ $dataLayanan->firstItem() + $loop->index }}</span>
            </td>
            <td class="py-4 px-6 text-gray-900">Andi Saputra</td>
            <td class="py-4 px-6 text-gray-900">08123456789</td>
            <td class="py-4 px-6 text-gray-900">andi@mail.com</td>
            <td class="py-4 px-6 text-gray-900">Jl. Melati No. 12</td>
            <td class="py-3 px-4">
                {{ $p->nama }}
            </td>

            <td class="py-3 px-4">
                {{ $p->no_hp }}
            </td>

            <td class="py-3 px-4">
                {{ $p->email }}
            </td>

            <td class="py-3 px-4">
                {{ $p->alamat }}
            </td>

            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">

                    <!-- EDIT -->
                    <button onclick="openEditModalPelanggan(
                                        '{{ $p->id_pelanggan }}',
                                        '{{ $p->nama }}',
                                        '{{ $p->no_hp }}',
                                        '{{ $p->email }}',
                                        '{{ $p->alamat }}'
                                    )" class="text-green-600 hover:text-green-800 p-1" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>

                    <!-- DELETE FORM -->
                    <form id="deleteForm{{ $p->id_pelanggan }}" action=" /pelanggan/{{ $p->id_pelanggan }}"
                        method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- DELETE BUTTON -->
                    <button onclick="confirmDelete('{{ $p->id_pelanggan }}')"
                        class=" text-red-600 hover:text-red-800 p-1" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>

                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">
                Belum ada data pelanggan.
            </td>
        </tr>
        @endforelse
    </tbody>

</table>