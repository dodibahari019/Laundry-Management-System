<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white z-10">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Detail Order</h2>
        <p class="text-sm text-gray-500 mt-1">Informasi lengkap pesanan laundry</p>
    </div>
    <button onclick="closeDetailCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto no-scrollbar">

    <!-- Header Order Info -->
    <div class="p-6 rounded-2xl border border-gray-300">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm text-gray-600 mb-1">Kode Order</p>
                <p class="text-3xl font-bold text-purple-600">{{ $dataOrder->kode_order }}</p>
            </div>
            <div class="text-right">
                @php
                    $statusColor = 'bg-yellow-100 text-yellow-700';

                    if($dataOrder->status_order == 'menunggu') {
                        $statusColor = 'bg-yellow-100 text-yellow-700';
                    } elseif($dataOrder->status_order == 'diproses') {
                        $statusColor = 'bg-blue-100 text-blue-700';
                    } elseif($dataOrder->status_order == 'dicuci') {
                        $statusColor = 'bg-orange-100 text-orange-700';
                    } elseif($dataOrder->status_order == 'disetrika') {
                        $statusColor = 'bg-purple-100 text-purple-700';
                    } elseif($dataOrder->status_order == 'ready') {
                        $statusColor = 'bg-green-100 text-green-700';
                    } elseif($dataOrder->status_order == 'diambil') {
                        $statusColor = 'bg-gray-100 text-gray-700';
                    } else {
                        $statusColor = 'bg-red-100 text-red-700';
                    }
                @endphp
                <span class="{{ $statusColor }} px-4 py-2 rounded-full text-sm font-bold inline-flex items-center space-x-2">
                    <span class="uppercase">{{ $dataOrder->status_order }}</span>
                </span>
            </div>
        </div>

        <!-- Timeline Tanggal -->
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="bg-white p-4 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-xs text-gray-500">Tanggal Masuk</p>
                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($dataOrder->tanggal_masuk)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-xs text-gray-500">Estimasi Selesai</p>
                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($dataOrder->tanggal_selesai)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Pelanggan -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center space-x-3 mb-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Informasi Pelanggan</h3>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Nama Pelanggan</p>
                <p class="font-semibold text-gray-900">{{ $dataOrder->nama }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">No. Telepon</p>
                <p class="font-semibold text-gray-900">{{ $dataOrder->no_hp }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Email</p>
                <p class="font-semibold text-gray-900">{{ $dataOrder->email }}</p>
            </div>
            <div class="col-span-3">
                <p class="text-sm text-gray-500 mb-1">Alamat</p>
                <p class="font-semibold text-gray-900">{{ $dataOrder->alamat }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Layanan (Table Format) -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center space-x-3 mb-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Detail Layanan</h3>
            <span class="ml-auto bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">{{ count($orderItems) }} Item</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-3 px-4 text-sm font-bold text-gray-700">No</th>
                        <th class="text-left py-3 px-4 text-sm font-bold text-gray-700">Nama Layanan</th>
                        <th class="text-center py-3 px-4 text-sm font-bold text-gray-700">Jenis</th>
                        <th class="text-center py-3 px-4 text-sm font-bold text-gray-700">Qty</th>
                        <th class="text-right py-3 px-4 text-sm font-bold text-gray-700">Harga Satuan</th>
                        <th class="text-right py-3 px-4 text-sm font-bold text-gray-700">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $index => $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-4 px-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="py-4 px-4">
                            <p class="font-semibold text-gray-900">{{ $item->nama_layanan }}</p>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <span class="{{ $item->jenis == 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }} px-3 py-1 rounded-full text-xs font-bold uppercase">
                                {{ $item->jenis }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <span class="font-bold text-gray-900">{{ $item->qty }}</span>
                            <span class="text-xs text-gray-500 ml-1">{{ $item->jenis == 'kiloan' ? 'Kg' : 'Pcs' }}</span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <p class="text-sm text-gray-900">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500">per {{ $item->jenis == 'kiloan' ? 'Kg' : 'Pcs' }}</p>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <p class="font-bold text-purple-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-gray-300 bg-gray-50">
                        <td colspan="5" class="py-4 px-4 text-right">
                            <span class="text-lg font-bold text-gray-900">Total Keseluruhan:</span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <span class="text-xl font-bold text-purple-600">Rp {{ number_format($dataOrder->total, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Informasi Pembayaran -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center space-x-3 mb-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Informasi Pembayaran</h3>
        </div>

        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Metode Pembayaran</span>
                <span class="font-bold text-gray-900 uppercase">{{ $dataOrder->metode }}</span>
            </div>

            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Total Harga</span>
                <span class="font-bold text-gray-900">Rp {{ number_format($dataOrder->total, 0, ',', '.') }}</span>
            </div>

            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                <span class="text-gray-600 font-medium">Total Bayar</span>
                <span class="font-bold text-green-600">Rp {{ number_format($dataOrder->jumlah, 0, ',', '.') }}</span>
            </div>

            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                <span class="text-gray-600 font-medium">Kembalian</span>
                <span class="font-bold text-blue-600">Rp {{ number_format($dataOrder->kembalian, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Riwayat Status -->
    <div class="bg-white border border-gray-300 rounded-2xl p-6">
        <div class="flex items-center space-x-3 mb-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900">Riwayat Status</h3>
        </div>

        <div class="space-y-4">
            @php
                function getStatusConfig($status) {
                    $configs = [
                        'menunggu' => ['label' => 'Menunggu Diproses', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                        'diproses' => ['label' => 'Sedang Diproses', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                        'dicuci' => ['label' => 'Sedang Dicuci', 'icon' => 'M5 3a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2H5zm7 14a5 5 0 110-10 5 5 0 010 10z M12 8a4 4 0 100 8 4 4 0 000-8z', 'bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                        'disetrika' => ['label' => 'Sedang Disetrika', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                        'ready' => ['label' => 'Siap Diambil', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'bg' => 'bg-green-100', 'text' => 'text-green-600'],
                        'diambil' => ['label' => 'Selesai & Diambil', 'icon' => 'M5 13l4 4L19 7', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'],
                        'dibatalkan' => ['label' => 'Order Dibatalkan', 'icon' => 'M6 18L18 6M6 6l12 12', 'bg' => 'bg-red-100', 'text' => 'text-red-600']
                    ];
                    return $configs[$status] ?? ['label' => ucfirst($status), 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'];
                }
            @endphp

            @foreach($dataOrderStatusLogs as $index => $log)
                @php
                    $config = getStatusConfig($log->status);
                    $isLast = $index === count($dataOrderStatusLogs) - 1;
                @endphp

                <div class="flex items-start space-x-4">
                    <div class="flex flex-col items-center">
                        <svg class="w-5 h-5 {{ $config['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                        </svg>
                        @if(!$isLast)
                        <div class="w-0.5 h-16 bg-gray-300"></div>
                        @endif
                    </div>
                    <div class="flex-1 {{ !$isLast ? 'pb-4' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="font-bold text-gray-900 text-base">{{ $config['label'] }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ \Carbon\Carbon::parse($log->tanggal_ubah)->format('d M Y, H:i') }} WIB
                                </p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-xs text-gray-600">oleh <span class="font-semibold text-purple-600">{{ $log->nama }}</span></span>
                                </div>
                            </div>
                            @if($index === 0)
                            <span class="px-3 py-1 {{ $config['bg'] }} {{ $config['text'] }} rounded-full text-xs font-bold uppercase">
                                Terbaru
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($role_login != 'kasir')
        <div class="bg-white border border-gray-300 rounded-2xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900">Update Status Order</h3>
            </div>
            <div class="flex items-center gap-4">
                <select id="filterStatusOrder" onchange="ChangeThisStatusOrder(this.value)" class="w-full px-6 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option selected>{{ $dataOrder->status_order }}</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="dicuci">Dicuci</option>
                    <option value="disetrika">Disetrika</option>
                    <option value="ready">Ready</option>
                    <option value="diambil">Diambil</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
                <form id="idChangeStatusOrder" action="/orders/{{ $dataOrder->id_order }}/change" method="POST">
                    @csrf
                    <input hidden readonly value="{{ $dataOrder->status_order }}" type="text" name="status_order" id="id_change_status_order">
                </form>
                <button onclick="onclickChangeOrders();" type="button" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center space-x-2">
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="py-6 border-t border-gray-300 flex items-center justify-between bg-white">
        <button type="button" onclick="closeDetailCrudModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Tutup
        </button>
        @if($dataOrder->status_order != 'dibatalkan')
            @if($role_login != 'petugas')
                <div class="flex space-x-3">
                    <button type="button" onclick="printOrder('{{ $dataOrder->id_order }}')" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span>Print</span>
                    </button>
                    <form id="cancelFormOrders" action="/orders/{{ $dataOrder->id_order }}/cancel" method="POST">
                        @csrf
                    </form>
                    <button onclick="onclickCancelOrders();" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Cancel Order</span>
                    </button>
                </div>
            @endif
        @endif
    </div>
</div>