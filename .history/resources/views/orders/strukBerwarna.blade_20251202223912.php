<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Order - {{ $dataOrder[0]->kode_order ?? '' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                max-width: 100%;
                box-shadow: none !important;
            }
        }
        
        @page {
            size: 80mm auto;
            margin: 0;
        }

        .dashed-line {
            border-top: 2px dashed #e5e7eb;
            margin: 16px 0;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-100 py-8">
    @foreach($dataOrder as $order)
    <div class="print-container max-w-sm mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden">
        
        <!-- Header dengan Logo -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white p-5 text-center">
            <h1 class="text-2xl font-bold mb-1">D`Laundry</h1>
            {{-- <p class="text-sm opacity-90">Bersih, Wangi, Cepat!</p> --}}
            <div class="mt-3 text-xs opacity-80">
                <p>Jl. Bandung No. 666, Kota Kembang</p>
                <p>Telp: (022) 1234-5678</p>
            </div>
        </div>

        <div class="p-6">
            <!-- Kode Order -->
            <div class="text-center mb-6 pb-4 border-b-2 border-gray-200">
                <p class="text-sm text-gray-500 mb-1">KODE ORDER</p>
                <p class="text-3xl font-bold gradient-text">{{ $order->kode_order }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d M Y, H:i') }} WIB</p>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="mb-6">
                <div class="flex items-center mb-3">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900">Informasi Pelanggan</h3>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-semibold text-gray-900">{{ $order->nama }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">No. HP:</span>
                        <span class="font-semibold text-gray-900">{{ $order->no_hp }}</span>
                    </div>
                    @if($order->email)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-semibold text-gray-900 text-xs">{{ $order->email }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="dashed-line"></div>

            <!-- Detail Layanan -->
            <div class="mb-6">
                <div class="flex items-center mb-3">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900">Detail Layanan</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-4 border border-purple-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-bold text-gray-900">{{ $order->nama_layanan }}</span>
                            <span class="px-3 py-1 bg-purple-600 text-white rounded-full text-xs font-bold uppercase">
                                {{ $order->jenis }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-gray-600">{{ $order->jenis == 'kiloan' ? 'Berat' : 'Jumlah' }}</p>
                                <p class="font-bold text-lg text-purple-700">
                                    {{ $order->jenis == 'kiloan' ? rtrim(rtrim(number_format($order->berat, 2, ',', '.'), '0'), ',') : $order->qty }}
                                    {{ $order->jenis == 'kiloan' ? 'Kg' : 'Pcs' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-600">Harga/{{ $order->jenis == 'kiloan' ? 'Kg' : 'Pcs' }}</p>
                                <p class="font-bold text-lg text-purple-700">
                                    Rp {{ number_format($order->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashed-line"></div>

            <!-- Rincian Pembayaran -->
            <div class="mb-6">
                <div class="flex items-center mb-3">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-900">Pembayaran</h3>
                </div>
                
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="dashed-line my-3"></div>
                    <div class="flex justify-between text-lg font-bold">
                        <span>TOTAL</span>
                        <span class="text-purple-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3 mt-3 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode</span>
                            <span class="font-bold uppercase">{{ $order->metode }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibayar</span>
                            <span class="font-semibold text-green-600">Rp {{ number_format($order->jumlah, 0, ',', '.') }}</span>
                        </div>
                        @if($order->kembalian > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kembalian</span>
                            <span class="font-semibold text-blue-600">Rp {{ number_format($order->kembalian, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="dashed-line"></div>

            <!-- Footer -->
            <div class="text-center space-y-4">
              
                <div class="text-xs text-gray-400">
                    <p>Dicetak: {{ \Carbon\Carbon::parse($currentlyDate)->format('d M Y, H:i') }} WIB</p>
                </div>

            </div>
        </div>
    </div>
    @endforeach

    <!-- Tombol Print -->
    <div class="no-print text-center mt-8 space-x-4">
        <button onclick="window.print()" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg transition inline-flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            <span>Print Struk</span>
        </button>
        <button onclick="window.close()" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition">
            Tutup
        </button>
    </div>

    <script>
        // Auto print saat halaman dibuka (opsional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>