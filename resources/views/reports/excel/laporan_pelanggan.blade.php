<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align: center; font-size: 18px; font-weight: bold; background-color: #8B5CF6; color: #FFFFFF; height: 40px;">
                LAPORAN PELANGGAN - D'LAUNDRY
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
            </th>
        </tr>
        <tr></tr>
        <tr style="background-color: #8B5CF6; color: #FFFFFF; font-weight: bold; height: 35px;">
            <th style="border: 1px solid #000; text-align: center; width: 5%;">No</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Nama Pelanggan</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">No HP</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Jumlah Transaksi</th>
            <th style="border: 1px solid #000; text-align: center; width: 18%;">Total Belanja (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 18%;">Rata-Rata Belanja (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Transaksi Terakhir</th>
        </tr>
    </thead>
    <tbody>
        @php $totalTransaksi = 0; $totalBelanja = 0; @endphp
        @foreach($data as $index => $item)
        @php
            $totalTransaksi += $item->jumlah_transaksi;
            $totalBelanja += $item->total_belanja;
        @endphp
        <tr style="height: 30px;">
            <td style="border: 1px solid #ccc; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->nama_pelanggan }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->no_hp }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->jumlah_transaksi, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->total_belanja, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->rata_rata_belanja, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_transaksi_terakhir)->format('d/m/Y') }}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr style="font-weight: bold; background-color: #E0E0E0; height: 35px;">
            <td colspan="3" style="border: 1px solid #000; text-align: right; padding-right: 10px;">TOTAL:</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #FFD700;">{{ number_format($totalTransaksi, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #90EE90;">{{ number_format($totalBelanja, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #ADD8E6;">{{ $totalTransaksi > 0 ? number_format($totalBelanja / $totalTransaksi, 0, ',', '.') : 0 }}</td>
            <td style="border: 1px solid #000;"></td>
        </tr>
    </tbody>
</table>