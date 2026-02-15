<table>
    <thead>
        <tr>
            <th colspan="8" style="text-align: center; font-size: 18px; font-weight: bold; background-color: #6D28D9; color: #FFFFFF; height: 40px;">
                LAPORAN LAYANAN - D'LAUNDRY
            </th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            </th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
            </th>
        </tr>
        <tr></tr>
        <tr style="background-color: #6D28D9; color: #FFFFFF; font-weight: bold; height: 35px;">
            <th style="border: 1px solid #000; text-align: center; width: 5%;">No</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Nama Layanan</th>
            <th style="border: 1px solid #000; text-align: center; width: 10%;">Jenis</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Harga Layanan (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Jumlah Transaksi</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Total Berat/Qty</th>
            <th style="border: 1px solid #000; text-align: center; width: 18%;">Total Pendapatan (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 8%;">Popularitas (%)</th>
        </tr>
    </thead>
    <tbody>
        @php $totalTransaksi = 0; $totalPendapatan = 0; @endphp
        @foreach($data as $index => $item)
        @php
            $totalTransaksi += $item->jumlah_transaksi;
            $totalPendapatan += $item->total_pendapatan;
            $totalQty = $item->jenis == 'kiloan' ? $item->total_berat : $item->total_qty;
            $satuan = $item->jenis == 'kiloan' ? 'Kg' : 'Pcs';
        @endphp
        <tr style="height: 30px;">
            <td style="border: 1px solid #ccc; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->nama_layanan }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ ucfirst($item->jenis) }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->harga_layanan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->jumlah_transaksi, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($totalQty, 2, ',', '.') }} {{ $satuan }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->popularitas, 2, ',', '.') }}%</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr style="font-weight: bold; background-color: #E0E0E0; height: 35px;">
            <td colspan="4" style="border: 1px solid #000; text-align: right; padding-right: 10px;">TOTAL:</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #FFD700;">{{ number_format($totalTransaksi, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000;"></td>
            <td style="border: 1px solid #000; text-align: right; background-color: #90EE90;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000;"></td>
        </tr>
    </tbody>
</table>