<table>
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-size: 18px; font-weight: bold; background-color: #6D28D9; color: #FFFFFF; height: 40px;">
                LAPORAN KEUANGAN - D'LAUNDRY
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
        <tr style="background-color: #6D28D9; color: #FFFFFF; font-weight: bold; height: 35px;">
            <th style="border: 1px solid #000; text-align: center; width: 5%;">No</th>
            <th style="border: 1px solid #000; text-align: center; width: 15%;">Tanggal</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Total Pendapatan (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Total Pengeluaran (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Laba/Rugi (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $item)
        @php
            $laba = $item->laba_bersih;
            $status = $laba > 0 ? 'Untung' : ($laba < 0 ? 'Rugi' : 'Break Even');
        @endphp
        <tr style="height: 30px;">
            <td style="border: 1px solid #ccc; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
            <td style="border: 1px solid #ccc; text-align: right; background-color: #D4EDDA;">{{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right; background-color: #F8D7DA;">{{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right; background-color: {{ $laba >= 0 ? '#D1ECF1' : '#F5C6CB' }};">{{ number_format($laba, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: center; font-weight: bold;">{{ $status }}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr style="font-weight: bold; background-color: #E0E0E0; height: 35px;">
            <td colspan="2" style="border: 1px solid #000; text-align: right; padding-right: 10px;">TOTAL:</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #90EE90;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #FFB6C1;">{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: right; background-color: {{ $labaBersih >= 0 ? '#ADD8E6' : '#FFA07A' }};">{{ number_format($labaBersih, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: center; font-weight: bold;">{{ $labaBersih > 0 ? 'Untung' : ($labaBersih < 0 ? 'Rugi' : 'Break Even') }}</td>
        </tr>
    </tbody>
</table>