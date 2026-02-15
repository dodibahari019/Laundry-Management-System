<div class=" w-full overflow-x-auto">
    <table class="min-w-max w-full border-collapse">
        <thead id="idHeaderTableLaporan" class="bg-gray-50">
            <tr>
                <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">No</th>
                <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Kode Order</th>
                <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Pelanggan</th>
                <th class="text-left py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Layanan</th>
                <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Total</th>
                <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Estimasi Selesai</th>
                <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Metode Pembayaran</th>
                <th class="text-center py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Tanggal Bayar</th>
                <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Dibayar</th>
                <th class="text-right py-4 px-6 text-xs font-semibold text-gray-600 uppercase">Kembalian</th>
            </tr>
        </thead>
        <tbody id="idBodyTableLaporan" class="divide-y divide-gray-100">
            @foreach($dataOrder as $index => $x)
            <tr class="hover:bg-gray-50 transition">
                <td class="py-4 px-6"><span class="font-semibold text-gray-900">{{ $index + 1 }}</span></td>
                <td class="py-4 px-6">
                    <div>
                        <p class="font-semibold text-purple-600">#{{ $x->kode_order }}</p>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($x->tanggal_masuk)->format('d M Y H:i') }}</p>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $x->nama }}</p>
                        <p class="text-xs text-gray-500">{{ $x->no_hp }}</p>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $x->nama_layanan }}</p>
                        <p class="text-xs text-gray-500">{{ $x->jenis }}</p>
                    </div>
                </td>
                {{-- <td class="py-4 px-6 text-center">
                    @php
                        $jenisColor = $x->jenis == 'kiloan'
                            ? 'bg-blue-100 text-blue-700'
                            : 'bg-purple-100 text-purple-700';
                        $beratQty = $x->jenis == 'kiloan'? $x->berat : $x->jumlah;
                        $satuan = $x->jenis == 'kiloan'? 'Kg' : 'Pcs'
                    @endphp
                    <span class="{{ $jenisColor }} px-3 py-1 rounded-full text-xs font-bold">{{ rtrim(rtrim(number_format($beratQty, 2, ',', '.'), '0'), ',') }} {{ $satuan }}</span>
                </td> --}}
                <td class="py-4 px-6 text-right">
                    <p class="font-bold text-gray-900">Rp {{number_format($x->total,0,',' , '.')}}</p>
                </td>
                <td class="py-4 px-6">
                    @php
                        $statusLaundry = $x->status_order;
                        $statusColor = 'bg-yellow-100 text-yellow-700';
                        if($statusLaundry == 'menunggu'){
                            $statusColor = 'bg-yellow-100 text-yellow-700';
                        } else if($statusLaundry == 'diproses'){
                            $statusColor = 'bg-blue-100 text-blue-700';
                        } else if($statusLaundry == 'dicuci'){
                            $statusColor = 'bg-orange-100 text-orange-700';
                        } else if($statusLaundry == 'disetrika'){
                            $statusColor = 'bg-purple-100 text-purple-700';
                        } else if($statusLaundry == 'ready'){
                            $statusColor = 'bg-green-100 text-green-700';
                        } else if($statusLaundry == 'diambil'){
                            $statusColor = 'bg-gray-100 text-gray-700';
                        } else {
                            $statusColor = 'bg-red-100 text-red-700';
                        }
                    @endphp
                    <div class="flex justify-center">
                        <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold">{{ $x->status_order }}</span>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($x->tanggal_selesai)->format('d M Y'); }}</span>
                    </div>
                </td>
                <td class="py-4 px-6">
                    @php
                        $metode = $x->metode;
                        $colorMethod = 'bg-green-100 text-green-700';
                        if($metode == 'qris'){
                            $colorMethod = 'bg-purple-100 text-purple-700';
                        } else if ($metode == 'transfer'){
                            $colorMethod = 'bg-blue-100 text-blue-700';
                        } else {
                            $colorMethod = 'bg-yellow-100 text-yellow-700';
                        }
                    @endphp
                    <span class="{{ $colorMethod }} px-3 py-1 rounded-full text-xs font-bold">{{ $x->metode }}</span>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($x->tanggal_masuk)->format('d M Y'); }}</span>
                    </div>
                </td>
                <td class="py-4 px-6 text-right">
                    <p class="font-bold text-gray-900">Rp {{number_format($x->jumlahBayar,0,',' , '.')}}</p>
                </td>
                <td class="py-4 px-6 text-right">
                    <p class="font-bold text-gray-900">Rp {{number_format($x->kembalian,0,',' , '.')}}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
