<table class="w-full">
    <thead class="bg-gray-50">
        <tr>
            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode Order</th>
            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pelanggan</th>
            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Layanan</th>
            <th class="py-4 px-6 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
            <th class="py-4 px-6 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estimasi Selesai</th>
            <th class="py-4 px-6 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody id="idBodyTableOrders" class="bg-white divide-y divide-gray-200">
        @foreach($dataOrder as $index => $order)
        @php
            $statusColor = 'bg-yellow-100 text-yellow-700';
            if($order->status_order == 'menunggu'){
                $statusColor = 'bg-yellow-100 text-yellow-700';
            } elseif($order->status_order == 'diproses'){
                $statusColor = 'bg-blue-100 text-blue-700';
            } elseif($order->status_order == 'dicuci'){
                $statusColor = 'bg-orange-100 text-orange-700';
            } elseif($order->status_order == 'disetrika'){
                $statusColor = 'bg-purple-100 text-purple-700';
            } elseif($order->status_order == 'ready'){
                $statusColor = 'bg-green-100 text-green-700';
            } elseif($order->status_order == 'diambil'){
                $statusColor = 'bg-gray-100 text-gray-700';
            } else {
                $statusColor = 'bg-red-100 text-red-700';
            }
        @endphp
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6">
                <span class="font-semibold text-gray-900">{{ $dataOrder->firstItem() + $index }}</span>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-purple-600">#{{ $order->kode_order }}</p>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d M Y H:i') }}</p>
                </div>
            </td>
            <td class="py-4 px-6">
                <div>
                    <p class="font-semibold text-gray-900">{{ $order->nama }}</p>
                    <p class="text-xs text-gray-500">{{ $order->no_hp }}</p>
                </div>
            </td>
            <td class="py-4 px-6 text-center">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">{{ $order->jumlah_layanan }} Layanan</span>
            </td>
            <td class="py-4 px-6 text-right">
                <p class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            </td>
            <td class="py-4 px-6">
                <div class="flex justify-center">
                    <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $order->status_order }}</span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center space-x-2">
                    @if($order->status_order == 'diambil')
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @else
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    @endif
                    <span class="text-sm text-gray-900">
                        {{ $order->status_order == 'diambil' ? 'Selesai' : \Carbon\Carbon::parse($order->tanggal_selesai)->format('d M Y') }}
                    </span>
                </div>
            </td>
            <td class="py-4 px-6">
                <div class="flex items-center justify-center space-x-2">
                    <button data-url-detail="/orders/{{ $order->id_order }}/detail" class="detail-modal-crud text-blue-600 hover:text-blue-800 p-1" title="Detail">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    {{-- @if($role_login != 'petugas')
                    <button data-url="/orders/{{ $order->id_order }}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    @endif --}}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>