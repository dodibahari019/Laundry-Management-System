@extends('layouts.frame')
@section('Title', 'Pengeluaran Operasional')
@section('HeaderTitle', 'Pengeluaran Operasional')
@section('Description', 'Kelola data pengeluaran operasional laundry')
@section('MainContentArea')
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pengeluaran</label>
                <div class="relative">
                    <input id="searchInput" type="text" placeholder="Cari nama pengeluaran..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select id="filterKategori" class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">Semua Kategori</option>
                    <option value="operasional">Operasional</option>
                    <option value="peralatan">Peralatan</option>
                    <option value="bahan">Bahan Baku</option>
                    <option value="gaji">Gaji Karyawan</option>
                    <option value="utilitas">Utilitas</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Filter Tanggal Dari -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                <input type="date" id="filterTanggalDari" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>

            <!-- Filter Tanggal Sampai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input type="date" id="filterTanggalSampai" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>

            <!-- Button Add -->
            <div class="flex items-end">
                <button data-url="/pengeluaran/create" class="modal-crud w-full px-4 py-3 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table Pengeluaran -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Daftar Pengeluaran</h2>
                <p id="jumlahPengeluaranInfo" class="text-sm text-gray-500 mt-1">Menampilkan {{ $jumlahSemua }} pengeluaran</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            @include('pengeluaran.table')
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-600"></div>
            <div id="paginationContainer" class="flex space-x-2">
                @if($pengeluaran->onFirstPage())
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Previous</button>
                @else
                    <button data-page="{{ $pengeluaran->currentPage() - 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Previous</button>
                @endif

                @foreach ($pengeluaran->getUrlRange(1, $pengeluaran->lastPage()) as $page => $url)
                    <button data-page="{{ $page }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ $pengeluaran->currentPage() == $page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50' }}">
                        {{ $page }}
                    </button>
                @endforeach

                @if($pengeluaran->hasMorePages())
                    <button data-page="{{ $pengeluaran->currentPage() + 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Next</button>
                @else
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Next</button>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('JavascriptSection')
<script>
    // ========================================
    // FORMAT RUPIAH
    // ========================================
    $(document).on('keyup', '.classRp', function () {
        let value = $(this).val().replace(/\D/g, '');
        if (value) {
            $(this).val(parseInt(value).toLocaleString('id-ID'));
        }
    });

    // ========================================
    // UPDATE TABLE (AJAX)
    // ========================================
    // ========================================
// UPDATE TABLE (AJAX)
// ========================================
function updateTable(res) {
    let html = '';

    if (res.data && res.data.length > 0) {
        res.data.forEach((x, index) => {
            let nomor = (res.current_page - 1) * res.per_page + index + 1;

            let badgeColors = {
                'operasional': 'bg-blue-100 text-blue-700',
                'peralatan': 'bg-purple-100 text-purple-700',
                'bahan': 'bg-green-100 text-green-700',
                'gaji': 'bg-yellow-100 text-yellow-700',
                'utilitas': 'bg-orange-100 text-orange-700',
                'lainnya': 'bg-gray-100 text-gray-700',
            };
            let colorClass = badgeColors[x.kategori] || 'bg-gray-100 text-gray-700';

            let kategoriNama = {
                'operasional': 'Operasional',
                'peralatan': 'Peralatan',
                'bahan': 'Bahan Baku',
                'gaji': 'Gaji Karyawan',
                'utilitas': 'Utilitas',
                'lainnya': 'Lainnya',
            };

            let tanggal = new Date(x.tanggal_pengeluaran).toLocaleDateString('id-ID');

            html += `
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                <td class="py-3 px-4 font-medium text-gray-900">${nomor}</td>
                <td class="py-3 px-4 text-sm text-gray-600 whitespace-nowrap">${tanggal}</td>
                <td class="py-3 px-4"><p class="font-semibold text-gray-900 leading-5">${x.nama_pengeluaran}</p></td>
                <td class="py-3 px-4">
                    <span class="inline-flex items-center ${colorClass} px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">
                        ${kategoriNama[x.kategori]}
                    </span>
                </td>
                <td class="py-3 px-4 text-right font-bold text-gray-900 whitespace-nowrap">
                    Rp ${Number(x.jumlah).toLocaleString('id-ID', { minimumFractionDigits: 0 })}
                </td>
                <td class="py-3 px-4">
                    <div class="flex items-center justify-center gap-3">
                        <button data-url="/pengeluaran/${x.id_pengeluaran}/edit" class="modal-crud text-green-600 hover:text-green-800 p-2 transition" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <form id="deleteForm${x.id_pengeluaran}" action="/pengeluaran/${x.id_pengeluaran}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button onclick="confirmDelete('${x.id_pengeluaran}')" class="text-red-600 hover:text-red-800 p-2 transition" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>`;
        });
    } else {
        html = `<tr><td colspan="6" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
    }

    $('#idBodyTablePengeluaran').html(html);

    // UPDATE FOOTER TOTAL - TAMBAHKAN INI
    updateFooter(res);
}

    // FUNGSI BARU - UPDATE FOOTER
    function updateFooter(res) {
        let footerHtml = '';
        
        if (res.data && res.data.length > 0) {
            footerHtml = `
            <tr>
                <td colspan="4" class="py-4 px-6 text-right">
                    <span class="text-sm font-bold text-gray-900">Total Pengeluaran:</span>
                </td>
                <td colspan="2" class="py-4 px-6 text-right">
                    <span class="text-lg font-bold text-red-600">
                        Rp ${Number(res.totalJumlah).toLocaleString('id-ID', { minimumFractionDigits: 0 })}
                    </span>
                </td>
            </tr>`;
            
            $('#tableFooter').html(footerHtml).show();
        } else {
            $('#tableFooter').hide();
        }
    }

    function updateInfo(res) {
        // Update jumlah pengeluaran
        $('#jumlahPengeluaranInfo').html(`Menampilkan ${res.total} pengeluaran`);

        // Update pagination
        let paginationHtml = '';

        // Previous
        if (res.current_page > 1) {
            paginationHtml += `<button data-page="${res.current_page - 1}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Previous</button>`;
        } else {
            paginationHtml += `<button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 opacity-50">Previous</button>`;
        }

        // Page numbers
        for (let page = 1; page <= res.last_page; page++) {
            paginationHtml += `<button data-page="${page}" class="px-3 py-2 rounded-lg text-sm font-semibold ${res.current_page == page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50'}">${page}</button>`;
        }

        // Next
        if (res.current_page < res.last_page) {
            paginationHtml += `<button data-page="${res.current_page + 1}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Next</button>`;
        } else {
            paginationHtml += `<button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 opacity-50">Next</button>`;
        }

        $('#paginationContainer').html(paginationHtml);
    }

    // Event delegation untuk pagination
    $(document).on('click', '#paginationContainer button[data-page]', function() {
        let page = $(this).data('page');
        fetchData(page);
    });

    // ========================================
    // FETCH DATA (AJAX)
    // ========================================
    let timer;
    function fetchData(page = 1) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let nama = $('#searchInput').val();
            let kategori = $('#filterKategori').val();
            let tanggal_dari = $('#filterTanggalDari').val();
            let tanggal_sampai = $('#filterTanggalSampai').val();

            $.ajax({
                url: '/pengeluaran/search',
                type: 'GET',
                data: { 
                    nama: nama, 
                    kategori: kategori, 
                    tanggal_dari: tanggal_dari,
                    tanggal_sampai: tanggal_sampai,
                    page: page 
                },
                success: function(res) {
                    updateTable(res);
                    updateInfo(res);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }, 400);
    }

    // Event listener
    $('#searchInput, #filterKategori, #filterTanggalDari, #filterTanggalSampai').on('keyup change', () => fetchData());

    // ========================================
    // VALIDASI CREATE
    // ========================================
    function JustRunThisButton() {
        let nama_pengeluaran = $('#id_nama_pengeluaran').val().trim();
        let kategori = $('#id_kategori').val();
        let jumlah = $('#id_jumlah').val().trim();
        let tanggal_pengeluaran = $('#id_tanggal_pengeluaran').val();

        let jumlahClean = jumlah.replace(/\./g, '').replace(/,/g, '');

        if (!nama_pengeluaran) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Nama Pengeluaran!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        if (!kategori) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Pilih Kategori!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        if (!jumlah || jumlahClean == '0' || jumlahClean == '') {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Jumlah Pengeluaran!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        if (!tanggal_pengeluaran) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Tanggal Pengeluaran!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        $('.classCreateForm').submit();
    }

    // ========================================
    // VALIDASI EDIT
    // ========================================
    function JustRunThisButtonEdit() {
        let nama_pengeluaran = $('#id_nama_pengeluaran_edit').val().trim();
        let kategori = $('#id_kategori_edit').val();
        let jumlah = $('#id_jumlah_edit').val().trim();
        let tanggal_pengeluaran = $('#id_tanggal_pengeluaran_edit').val();

        let jumlahClean = jumlah.replace(/\./g, '').replace(/,/g, '');

        if (!nama_pengeluaran) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Nama Pengeluaran!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        if (!kategori) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Pilih Kategori!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        if (!jumlah || jumlahClean == '0' || jumlahClean == '') {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Jumlah Pengeluaran!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        if (!tanggal_pengeluaran) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Tanggal Pengeluaran!",
                timer: 2000,
                timerProgressBar: true,
            });
            return false;
        }

        $('.classEditForm_Edit').submit();
    }

    // ========================================
    // DELETE CONFIRMATION
    // ========================================
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pengeluaran akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6D28D9',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endsection