<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
    <title>Struk Order - {{ $dataOrder[0]->kode_order ?? '' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: #f5f5f5;
            padding: 20px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none !important;
            }
            .struk-container {
                box-shadow: none !important;
                border: none !important;
            }
        }

        @page {
            size: 80mm auto;
            margin: 0;
        }

        .struk-container {
            width: 80mm;
            max-width: 302px;
            margin: 0 auto;
            background: white;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .large {
            font-size: 16px;
        }

        .medium {
            font-size: 14px;
        }

        .small {
            font-size: 10px;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mt-1 {
            margin-top: 5px;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .dashed {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .solid {
            border-top: 2px solid #000;
            margin: 10px 0;
        }

        .double {
            border-top: 3px double #000;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }

        .header-logo {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .box {
            border: 1px solid #000;
            padding: 8px;
            margin: 10px 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
        }

        .footer-note {
            border: 1px dashed #000;
            padding: 8px;
            margin-top: 10px;
        }

        /* Print Button Styles */
        .print-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .btn-print {
            background: #000;
            color: white;
        }

        .btn-close {
            background: #ddd;
            color: #333;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    @foreach($dataOrder as $order)
    <div class="struk-container">

        <!-- HEADER -->
        <div class="text-center mb-2">
            <div class="header-logo">D'LAUNDRY</div>
            <div class="small">Jl. Bandung No. 666, Kota Kembang</div>
            <div class="small">Telp: (022) 1234-5678</div>
        </div>

        <div class="double"></div>

        <!-- KODE ORDER -->
        <div class="text-center mb-2">
            <div class="small">KODE ORDER</div>
            <div class="large bold">{{ $order->kode_order }}</div>
            <div class="small">{{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d/m/Y H:i') }} WIB</div>
        </div>

        <div class="dashed"></div>

        <!-- PELANGGAN -->
        <div class="mb-2">
            <div class="bold mb-1">INFORMASI PELANGGAN</div>
            <div class="info-row">
                <span>Nama</span>
                <span class="bold">{{ $order->nama }}</span>
            </div>
            <div class="info-row">
                <span>No. HP</span>
                <span class="bold">{{ $order->no_hp }}</span>
            </div>
            @if($order->email)
            <div class="info-row">
                <span>Email</span>
                <span class="small">{{ $order->email }}</span>
            </div>
            @endif
            {{-- @if($order->alamat)
            <div class="mt-1 small">
                <div>Alamat:</div>
                <div>{{ $order->alamat }}</div>
            </div>
            @endif --}}
        </div>

        <div class="dashed"></div>

        <!-- DETAIL LAYANAN -->
        <div class="mb-2">
            <div class="bold mb-1">DETAIL LAYANAN</div>

            <div class="box">
                <div class="info-row">
                    <span class="bold">{{ $order->nama_layanan }}</span>
                    <span class="small bold">[{{ strtoupper($order->jenis) }}]</span>
                </div>
                <div class="dashed"></div>
                <table>
                    <tr>
                        <td>{{ $order->jenis == 'kiloan' ? 'Berat' : 'Jumlah' }}</td>
                        <td class="text-right bold">
                            {{ $order->jenis == 'kiloan' ? rtrim(rtrim(number_format($order->berat, 2, ',', '.'), '0'), ',') : $order->qty }}
                            {{ $order->jenis == 'kiloan' ? 'Kg' : 'Pcs' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Harga/{{ $order->jenis == 'kiloan' ? 'Kg' : 'Pcs' }}</td>
                        <td class="text-right">Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="dashed"></div>

        <!-- RINCIAN PEMBAYARAN -->
        <div class="mb-2">
            <div class="bold mb-1">RINCIAN PEMBAYARAN</div>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="solid"></div>

            <table>
                <tr>
                    <td class="bold large">TOTAL</td>
                    <td class="text-right bold large">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="dashed"></div>

            <table class="small">
                <tr>
                    <td>Metode Bayar</td>
                    <td class="text-right bold">{{ strtoupper($order->metode) }}</td>
                </tr>
                <tr>
                    <td>Dibayar</td>
                    <td class="text-right">Rp {{ number_format($order->jumlah, 0, ',', '.') }}</td>
                </tr>
                @if($order->kembalian > 0)
                <tr>
                    <td>Kembalian</td>
                    <td class="text-right bold">Rp {{ number_format($order->kembalian, 0, ',', '.') }}</td>
                </tr>
                @endif
            </table>
        </div>

        <div class="dashed"></div>

        <!-- STATUS & TANGGAL -->
        <div class="mb-2">
            {{-- <div class="info-row">
                <span>Status</span>
                <span class="bold">[{{ strtoupper($order->status_order) }}]</span>
            </div> --}}
            <div class="info-row">
                <span>Tgl Order</span>
                <span>{{ \Carbon\Carbon::parse($order->tanggal_masuk)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span>Est. Selesai</span>
                <span class="bold">{{ \Carbon\Carbon::parse($order->tanggal_selesai)->format('d/m/Y') }}</span>
            </div>
        </div>

        <!-- CATATAN -->
        @if($order->catatan)
        <div class="dashed"></div>
        <div class="mb-2">
            <div class="bold mb-1">CATATAN:</div>
            <div class="small">{{ $order->catatan }}</div>
        </div>
        @endif

        <div class="double"></div>

        <!-- FOOTER -->
        <div class="footer-note">
            <div class="text-center small">
                <div class="bold mb-1">TERIMA KASIH</div>
                <div>Barang yang sudah dicuci</div>
                <div>tidak dapat dikembalikan</div>
                <div class="mt-1">Ambil cucian maks. 7 hari</div>
                <div>setelah selesai</div>
            </div>
        </div>

        <div class="text-center small mt-2">
            <div>Dicetak: {{ \Carbon\Carbon::parse($currentlyDate)->format('d/m/Y H:i') }}</div>
        </div>

        <!-- BARCODE PLACEHOLDER -->
        <div class="text-center mt-2">
            <div style="display: inline-block; padding: 5px; border: 1px solid #000;">
                <div style="display: flex; height: 40px; gap: 2px;">
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 4px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 6px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 4px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 6px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 4px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 6px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 4px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 6px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 4px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 6px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                    <div style="width: 4px; background: #000;"></div>
                    <div style="width: 2px; background: #000;"></div>
                </div>
                <div class="text-center small">{{ $order->kode_order }}</div>
            </div>
        </div>

    </div>
    @endforeach

    <!-- TOMBOL PRINT -->
    <div class="no-print print-buttons">
        <button onclick="window.print()" class="btn btn-print">🖨️ CETAK STRUK</button>
        <button onclick="window.close()" class="btn btn-close">✕ TUTUP</button>
    </div>

    <script>
        // Auto print saat halaman dibuka (aktifkan jika diperlukan)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>
