@extends('layouts.frame')
@section('Title', 'Dashboard')
@section('CssSection')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .hover-scale {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hover-scale:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .chart-container {
        position: relative;
        height: 280px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease;
    }
</style>
@endsection

@section('HeaderTitle', 'Dashboard')
@section('Description', 'Ringkasan operasional laundry hari ini')

@section('MainContentArea')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 fade-in">
    
    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <span id="percentOrderToday" class="text-green-600 text-sm font-semibold flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                +0%
            </span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Order Hari Ini</h3>
        <p id="totalOrderToday" class="text-3xl font-bold text-gray-900">0</p>
        <p id="infoOrderYesterday" class="text-xs text-gray-400 mt-2">Dari kemarin: 0 order</p>
    </div>

    {{-- Card 2: Dalam Proses --}}
    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">PROSES</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Dalam Proses Hari Ini</h3>
        <p id="totalOrderProcess" class="text-3xl font-bold text-gray-900">0</p>
        <p id="detailOrderProcess" class="text-xs text-gray-400 mt-2">0 cuci • 0 setrika</p>
    </div>

    {{-- Card 3: Selesai Hari Ini --}}
    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">SELESAI</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Selesai Hari Ini</h3>
        <p id="totalOrderDone" class="text-3xl font-bold text-gray-900">0</p>
        <p id="detailOrderTaken" class="text-xs text-gray-400 mt-2">0 sudah diambil</p>
    </div>

    {{-- Card 4: Pendapatan Hari Ini --}}
    <div class="bg-white rounded-2xl p-6 hover-scale border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span id="percentRevenueToday" class="text-purple-600 text-sm font-semibold flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                +0%
            </span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Pendapatan Hari Ini</h3>
        <p id="totalRevenueToday" class="text-3xl font-bold text-gray-900">Rp 0</p>
        <p id="revenueYesterday" class="text-xs text-gray-400 mt-2">Pendapatan Kemarin: Rp 0</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 fade-in">
    
    <div class="bg-white rounded-2xl p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Order 7 Hari Terakhir</h3>
            <span class="text-xs text-gray-500">Minggu Ini</span>
        </div>
        <div class="chart-container">
            <canvas id="orderChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Pendapatan Mingguan</h3>
            <span class="text-xs text-gray-500">Minggu Ini</span>
        </div>
        <div class="chart-container">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 fade-in">
    <div class="bg-white rounded-2xl p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Status Order Real-Time</h3>
        <div class="chart-container">
            <canvas id="statusChart"></canvas>
        </div>
        <div class="grid grid-cols-3 gap-3 mt-4">
            <div class="text-center p-2 bg-yellow-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Menunggu</p>
                <p id="statusWaiting" class="text-2xl font-bold text-yellow-700">0</p>
            </div>
            <div class="text-center p-2 bg-blue-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Diproses</p>
                <p id="statusProcess" class="text-2xl font-bold text-blue-700">0</p>
            </div>
            <div class="text-center p-2 bg-orange-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Dicuci</p>
                <p id="statusWashing" class="text-2xl font-bold text-orange-700">0</p>
            </div>
            <div class="text-center p-2 bg-purple-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Setrika</p>
                <p id="statusIroning" class="text-2xl font-bold text-purple-700">0</p>
            </div>
            <div class="text-center p-2 bg-green-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Siap</p>
                <p id="statusReady" class="text-2xl font-bold text-green-700">0</p>
            </div>
            <div class="text-center p-2 bg-gray-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Diambil</p>
                <p id="statusDiambil" class="text-2xl font-bold text-gray-700">0</p>
            </div>
            {{-- <div class="text-center p-2 bg-red-100 rounded-lg">
                <p class="text-xs text-gray-600 mb-1">Dibatalkan</p>
                <p id="statusCancel" class="text-2xl font-bold text-red-700">0</p>
            </div> --}}
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Distribusi Layanan</h3>
        <div class="chart-containerFake h-85">
            <canvas id="serviceChart"></canvas>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden fade-in">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Order Terbaru</h2>
        <button onclick="window.location.href='/orders'" class="text-sm text-purple-600 font-semibold hover:underline">
            Lihat Semua 
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Kode Order</th>
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Pelanggan</th>
                    <th class="text-left py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Layanan</th>
                    <th class="text-center py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="text-right py-3 px-4 text-xs font-semibold text-gray-600 uppercase">Total</th>
                </tr>
            </thead>
            <tbody id="recentOrdersTable">
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('JavascriptSection')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
function formatRupiah(angka) {
    return 'Rp ' + Number(angka).toLocaleString('id-ID', { 
        minimumFractionDigits: 0, 
        maximumFractionDigits: 0 
    });
}

function formatBerat(value) {
    let num = parseFloat(value);
    let str = num.toFixed(2).replace(/\.?0+$/, '');
    return str.replace('.', ',');
}

function formatTanggal(tanggal) {
    if (!tanggal) return '-';
    const bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
    let dateObj = new Date(tanggal);
    if (isNaN(dateObj)) return tanggal;
    return `${dateObj.getDate()} ${bulan[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
}

function getStatusBadge(status) {
    const statusMap = {
        'menunggu': 'bg-yellow-100 text-yellow-700',
        'diproses': 'bg-blue-100 text-blue-700',
        'dicuci': 'bg-orange-100 text-orange-700',
        'disetrika': 'bg-purple-100 text-purple-700',
        'ready': 'bg-green-100 text-green-700',
        'diambil': 'bg-gray-100 text-gray-700'
    };
    return statusMap[status] || 'bg-gray-100 text-gray-700';
}

function fetchDashboardData() {
    $.ajax({
        url: '/dashboard/getData',
        type: 'GET',
        success: function(res) {
            updateCards(res);
            updateCharts(res);
            // updateQueue(res.queueOrders || []);
            updateRecentOrders(res.recentOrders || []);
        },
        error: function(err) {
            console.error('Error fetching dashboard data:', err);
        }
    });
}

function updateCards(data) {
    $('#totalOrderToday').text(data.totalOrderToday || 0);
    $('#infoOrderYesterday').text(`Dari kemarin: ${data.totalOrderYesterday || 0} order`);
    
    let percentChange = 0;
    if (data.totalOrderYesterday > 0) {
        percentChange = (((data.totalOrderToday - data.totalOrderYesterday) / data.totalOrderYesterday) * 100).toFixed(0);
    }
    $('#percentOrderToday').html(`
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${percentChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3'}"></path>
        </svg>
        ${percentChange >= 0 ? '+' : ''}${percentChange}%
    `).removeClass('text-green-600 text-red-600').addClass(percentChange >= 0 ? 'text-green-600' : 'text-red-600');

    $('#totalOrderProcess').text(data.totalOrderProcess || 0);
    $('#detailOrderProcess').text(`${data.prosesCount || 0} diproses . ${data.cuciCount || 0} cuci . ${data.setrikaCount || 0} setrika`);

    $('#totalOrderDone').text(data.totalOrderDone || 0);
    $('#detailOrderTaken').text(`${data.takenCount || 0} sudah diambil`);

    $('#totalRevenueToday').text(formatRupiah(data.totalRevenueToday || 0));
    $('#revenueYesterday').text(`Pendapatan Kemarin: ${formatRupiah(data.revenueYesterday || 0)}`);
    
    let revenuePercent = 0;
    if (data.revenueYesterday > 0) {
        revenuePercent = (((data.totalRevenueToday - data.revenueYesterday) / data.revenueYesterday) * 100).toFixed(0);
    }
    $('#percentRevenueToday').html(`
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${revenuePercent >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3'}"></path>
        </svg>
        ${revenuePercent >= 0 ? '+' : ''}${revenuePercent}%
    `).removeClass('text-green-600 text-red-600').addClass(revenuePercent >= 0 ? 'text-purple-600' : 'text-red-600');

    $('#statusWaiting').text(data.statusWaiting || 0);
    $('#statusProcess').text(data.statusProcess || 0);
    $('#statusWashing').text(data.statusWashing || 0);
    $('#statusIroning').text(data.statusIroning || 0);
    $('#statusReady').text(data.statusReady || 0);
    $('#statusDiambil').text(data.statusDiambil || 0);
}

let orderChart, revenueChart, statusChart, serviceChart;

function updateCharts(data) {
    const orderCtx = document.getElementById('orderChart').getContext('2d');
    if (orderChart) orderChart.destroy();
    orderChart = new Chart(orderCtx, {
        type: 'line',
        data: {
            labels: data.orderChartLabels || [],
            datasets: [{
                label: 'Order',
                data: data.orderChartData || [],
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#9CA3AF' } },
                x: { ticks: { color: '#9CA3AF' } }
            }
        }
    });

    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    if (revenueChart) revenueChart.destroy();
    revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: data.revenueChartLabels || [],
            datasets: [{
                label: 'Pendapatan (Ribu)',
                data: data.revenueChartData || [],
                backgroundColor: 'rgba(139, 92, 246, 0.8)',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#9CA3AF', callback: v => v + 'k' } },
                x: { ticks: { color: '#9CA3AF' } }
            }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    if (statusChart) statusChart.destroy();
    statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Menunggu', 'DiProses', 'Dicuci', 'Setrika', 'Siap', 'Diambil'],
            datasets: [{
                data: data.statusChartData || [0, 0, 0, 0, 0, 0],
                backgroundColor: ['#FBBF24', '#3B82F6', '#FB923C', '#A855F7', '#10B981', '#6B7280']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    const serviceCtx = document.getElementById('serviceChart').getContext('2d');
    if (serviceChart) serviceChart.destroy();
    serviceChart = new Chart(serviceCtx, {
        type: 'pie',
        data: {
            labels: data.serviceChartLabels || [],
            datasets: [{
                data: data.serviceChartData || [],
                backgroundColor: ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#43e97b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    display: true,
                    position: 'bottom',
                    labels: { 
                        boxWidth: 20, 
                        padding: 15, 
                        font: { size: 15 }, 
                        generateLabels: function(chart) {
                            const original = Chart.overrides.pie.plugins.legend.labels.generateLabels(chart);
                            return original.map(label => ({
                                ...label,
                                // setiap label memaksa break line
                                text: label.text + "\n"
                            }));
                        }
                    }
                } 
            }
        }
    });
}


function updateQueue(orders) {
    let html = '';
    let waitingCount = 0;

    if (orders.length === 0) {
        html = '<p class="text-center text-gray-500 py-4">Tidak ada antrian</p>';
    } else {
        orders.slice(0, 5).forEach(x => {
            if (x.status_order === 'menunggu') waitingCount++;
            
            let statusColor = getStatusBadge(x.status_order);
            let jenisColor = x.layanan.jenis === 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700';
            let beratQty = formatBerat(x.layanan.jenis === 'kiloan' ? x.berat : x.jumlah);
            let satuan = x.layanan.jenis === 'kiloan' ? 'Kg' : 'Pcs';

            html += `
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-purple-300 transition">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-gray-200">
                        <span class="text-purple-600 font-bold text-sm">#${x.kode_order}</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">${x.pelanggan.nama}</p>
                        <p class="text-sm text-gray-500">${x.layanan.nama_layanan} • <span class="${jenisColor} px-2 py-0.5 rounded text-xs font-semibold">${beratQty} ${satuan}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="${statusColor} px-3 py-1 rounded-full text-xs font-bold uppercase">${x.status_order}</span>
                </div>
            </div>
            `;
        });
    }

    $('#queueContainer').html(html);
    $('#queueBadge').text(`${waitingCount} MENUNGGU`);
}

function formatTanggalWaktu(tanggal) {
    if (!tanggal) return '-';

    const bulan = [
        "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
        "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
    ];

    let dateObj = new Date(tanggal);
    if (isNaN(dateObj)) return tanggal; // kalau gagal parse

    let hari = dateObj.getDate();
    let bulanText = bulan[dateObj.getMonth()];
    let tahun = dateObj.getFullYear();

    // ambil jam-menit
    let jam = dateObj.getHours().toString().padStart(2, '0');
    let menit = dateObj.getMinutes().toString().padStart(2, '0');
    let detik = dateObj.getSeconds().toString().padStart(2, '0');

    // cek apakah input punya waktu (timestamp > 00:00:00)
    let adaWaktu = tanggal.toString().includes(':') ||
                    dateObj.getHours() !== 0 ||
                    dateObj.getMinutes() !== 0 ||
                    dateObj.getSeconds() !== 0;

    return `${hari} ${bulanText} ${tahun} ${jam}:${menit}`;
}

function updateRecentOrders(orders) {
    let html = '';

    if (orders.length === 0) {
        html = '<tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada order terbaru</td></tr>';
    } else {
        orders.slice(0, 5).forEach(x => {
            let statusColor = getStatusBadge(x.status_order);
            let jenisColor = x.layanan.jenis === 'kiloan' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700';

            html += `
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                <td class="py-3 px-4">
                    <span class="font-semibold text-purple-600">#${x.kode_order}</span>
                    <p class="text-xs text-gray-500">${formatTanggalWaktu(x.tanggal_masuk)}</p>
                </td>
                <td class="py-3 px-4">
                    <p class="font-medium text-gray-900">${x.pelanggan.nama}</p>
                    <p class="text-xs text-gray-500">${x.pelanggan.no_hp}</p>
                </td>
                <td class="py-3 px-4">
                    <p class="text-sm text-gray-900">${x.layanan.nama_layanan}</p>
                    <span class="${jenisColor} px-2 py-0.5 rounded text-xs font-semibold">${x.layanan.jenis}</span>
                </td>
                <td class="py-3 px-4 text-center">
                    <span class="${statusColor} px-3 py-1 rounded-full text-xs font-bold uppercase">${x.status_order}</span>
                </td>
                <td class="py-3 px-4 text-right">
                    <p class="font-bold text-gray-900">${formatRupiah(x.total)}</p>
                </td>
            </tr>
            `;
        });
    }

    $('#recentOrdersTable').html(html);
}

$(document).ready(function() {
    fetchDashboardData();
    setInterval(fetchDashboardData, 300000);
});
</script>
@endsection