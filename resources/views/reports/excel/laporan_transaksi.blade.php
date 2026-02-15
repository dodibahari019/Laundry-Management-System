<table>
    <thead>
        <tr>
            <th colspan="11" style="text-align: center; font-size: 18px; font-weight: bold; background-color: #6D28D9; color: #FFFFFF; height: 40px;">
                LAPORAN TRANSAKSI - D'LAUNDRY
            </th>
        </tr>
        <tr>
            <th colspan="11" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            </th>
        </tr>
        <tr>
            <th colspan="11" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
            </th>
        </tr>
        <tr></tr>
        <tr style="background-color: #6D28D9; color: #FFFFFF; font-weight: bold; height: 35px;">
            <th style="border: 1px solid #000; text-align: center; width: 5%;">No</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Kode Order</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Tanggal Masuk</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Nama Pelanggan</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">No HP</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Layanan</th>
            <th style="border: 1px solid #000; text-align: center; width: 8%;">Jenis</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Total (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 10%;">Status</th>
            <th style="border: 1px solid #000; text-align: center; width: 10%;">Metode</th>
            <th style="border: 1px solid #000; text-align: center; width: 12%;">Dibayar (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @php $totalPendapatan = 0; $totalDibayar = 0; @endphp
        @foreach($data as $index => $item)
        @php
            $totalPendapatan += $item->total;
            $totalDibayar += $item->jumlahBayar;
        @endphp
        <tr style="height: 30px;">
            <td style="border: 1px solid #ccc; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #ccc;">#{{ $item->kode_order }}</td>
            <td style="border: 1px solid #ccc;">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y H:i') }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->nama }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->no_hp }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->nama_layanan }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ ucfirst($item->jenis) }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->total, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ strtoupper($item->status_order) }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ strtoupper($item->metode) }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->jumlahBayar, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr style="font-weight: bold; background-color: #E0E0E0; height: 35px;">
            <td colspan="7" style="border: 1px solid #000; text-align: right; padding-right: 10px;">TOTAL:</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #FFD700;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            <td colspan="2" style="border: 1px solid #000;"></td>
            <td style="border: 1px solid #000; text-align: right; background-color: #90EE90;">{{ number_format($totalDibayar, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>