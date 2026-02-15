<table>
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-size: 18px; font-weight: bold; background-color: #EF4444; color: #FFFFFF; height: 40px;">
                LAPORAN PENGELUARAN - D'LAUNDRY
            </th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            </th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
            </th>
        </tr>
        <tr></tr>
        <tr style="background-color: #EF4444; color: #FFFFFF; font-weight: bold; height: 35px;">
            <th style="border: 1px solid #000; text-align: center; width: 5%;">No</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Tanggal</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Nama Pengeluaran</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Kategori</th>
            <th style="border: 1px solid #000; text-align: center; width: 25%;">Deskripsi</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Jumlah (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @php $totalPengeluaran = 0; @endphp
        @foreach($data as $index => $item)
        @php
            $totalPengeluaran += $item->jumlah;
        @endphp
        <tr style="height: 30px;">
            <td style="border: 1px solid #ccc; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d/m/Y') }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->nama_pengeluaran }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ ucfirst($item->kategori) }}</td>
            <td style="border: 1px solid #ccc;">{{ $item->deskripsi ?? '-' }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr style="font-weight: bold; background-color: #E0E0E0; height: 35px;">
            <td colspan="5" style="border: 1px solid #000; text-align: right; padding-right: 10px;">TOTAL PENGELUARAN:</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #FFB6C1;">{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>