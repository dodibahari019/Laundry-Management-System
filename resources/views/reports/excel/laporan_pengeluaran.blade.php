<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <table>
        <tr>
            <td colspan="7" style="text-align: center; font-size: 14pt; font-weight: bold;">
                LAPORAN PENGELUARAN
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center;">
                Periode: {{ $periode }}
            </td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>

        <tr style="background-color: #f0f0f0; font-weight: bold;">
            <td>No</td>
            <td>Tanggal</td>
            <td>Nama Pengeluaran</td>
            <td>Kategori</td>
            <td>Deskripsi</td>
            <td>Jumlah</td>
        </tr>

        @php $totalPengeluaran = 0; @endphp
        @foreach($data as $index => $item)
            @php $totalPengeluaran += $item->jumlah; @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d/m/Y') }}</td>
                <td>{{ $item->nama_pengeluaran }}</td>
                <td>{{ ucfirst($item->kategori_pengeluaran ?? '-') }}</td>
                <td>{{ $item->deskripsi ?? '-' }}</td>
                <td style="text-align: right;">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
        @endforeach

        <tr style="background-color: #f0f0f0; font-weight: bold;">
            <td colspan="5" style="text-align: right;">TOTAL PENGELUARAN:</td>
            <td style="text-align: right;">{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            <td></td>
        </tr>
    </table>
</body>

</html>