<table class="w-full">
    <thead class="bg-gray-50">
         <tr>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Username</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Nama</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Email</th>
            <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Role</th>
            <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody id="idBodyTableUsers" class="divide-y divide-gray-100">
        @foreach($dataUsers as $index => $x)
            <tr class="hover:bg-gray-50 transition">
                <td class="py-4 px-6 font-semibold">{{ $dataUsers->firstItem() + $loop->index }}</td>
                <td class="py-4 px-6 font-semibold text-gray-900">{{ $x->username }}</td>
                <td class="py-4 px-6 text-gray-900">{{ $x->nama }}</td>
                <td class="py-4 px-6 text-gray-900">{{ $x->email }}</td>
                <td class="py-4 px-6">
                    @php
                        $roleUsers = $x->role;
                        $statusColor = 'bg-purple-100 text-purple-700';
                        if($roleUsers == 'admin'){
                            $statusColor = 'bg-purple-100 text-purple-700';
                        } else if($roleUsers == 'kasir'){
                            $statusColor = 'bg-green-100 text-green-700';
                        } else {
                            $statusColor = 'bg-red-100 text-red-700';
                        }
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                        {{ $x->role }}
                    </span>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center justify-center space-x-2">
                        <button data-url="/users/{{ $x->id_user }}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <form id="deleteFormUsers{{ $x->id_user }}" action="/users/{{ $x->id_user }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button onclick="confirmDeleteUsers('{{ $x->id_user }}', this)" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
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
