@extends('layouts.frame')
@section('Title', 'Layanan')
@section('CssSection')

@endsection
@section('HeaderTitle', 'Layanan Laundry')
@section('Description', 'Kelola data akun pengguna seperti admin, kasir, dan petugas')
@section('MainContentArea')
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Layanan</label>
                <div class="relative">
                    <input id="searchInput" type="text" placeholder="Cari nama layanan..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Jenis -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                <select id="filterJenis" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">Semua Jenis</option>
                    <option value="kiloan">Kiloan</option>
                    <option value="satuan">Satuan</option>
                </select>
            </div>

            <!-- Filter Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rentang Harga</label>
                <select id="filterHarga" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">Semua Harga</option>
                    <option value="lt5000">< Rp 5.000</option>
                    <option value="5000-10000">Rp 5.000 - Rp 10.000</option>
                    <option value="gt10000">> Rp 10.000</option>
                </select>
            </div>

            <!-- Button Add -->
            <div class="flex items-end">
                <button data-url="/layanan/create" class="modal-crud w-full px-4 py-2.5 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table Layanan -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Daftar Layanan</h2>
                <p id="jumlahLayananInfo" class="text-sm text-gray-500 mt-1">Menampilkan {{ $jumlahSemua }} layanan</p>
            </div>
            {{-- <div class="flex space-x-3">
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export</span>
                </button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Print</span>
                </button>
            </div> --}}
        </div>

        <div class="overflow-x-auto">
            @include('layanan.table')
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                {{-- Menampilkan <span class="font-semibold">{{ $dataLayanan->firstItem() }}-{{ $dataLayanan->lastItem() }}</span> dari <span class="font-semibold">{{ $dataLayanan->total() }}</span> layanan --}}
            </div>
            <div id="paginationContainer" class="flex space-x-2">
                @if($dataLayanan->onFirstPage())
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Previous</button>
                @else
                    <button data-page="{{ $dataLayanan->currentPage() - 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Previous</button>
                @endif

                @foreach ($dataLayanan->getUrlRange(1, $dataLayanan->lastPage()) as $page => $url)
                    <button data-page="{{ $page }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ $dataLayanan->currentPage() == $page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50' }}">
                        {{ $page }}
                    </button>
                @endforeach

                @if($dataLayanan->hasMorePages())
                    <button data-page="{{ $dataLayanan->currentPage() + 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Next</button>
                @else
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Next</button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Edit Layanan -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Edit Layanan</h2>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi layanan</p>
                </div>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ID Layanan</label>
                        <input type="text" value="LYN001" disabled class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan *</label>
                        <input type="text" value="Cuci Kering" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan *</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                            <option selected>Kiloan</option>
                            <option>Satuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                            <input type="number" value="5000" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Pengerjaan *</label>
                        <div class="flex space-x-3">
                            <input type="number" value="2" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                            <select class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                                <option>Jam</option>
                                <option selected>Hari</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                            <option selected>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Layanan</label>
                    <textarea rows="4" placeholder="Jelaskan detail layanan..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">Regular laundry service untuk pakaian sehari-hari</textarea>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Update Layanan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('JavascriptSection')
<script>
function updateTable(res) {
    let html = '';

    if (res.data && res.data.length > 0) {
        res.data.forEach((x, index) => {
            // Nomor urut
            let nomor = (res.current_page - 1) * res.per_page + index + 1;

            // Durasi
            let hari = Math.floor(x.durasi / 24);
            let jam = x.durasi % 24;

            // Warna jenis
            let jenisColor = x.jenis == 'kiloan'
                ? 'bg-blue-100 text-blue-700'
                : 'bg-purple-100 text-purple-700';

            // Warna status
            let statusColor = x.status == 'Aktif'
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700';

            html += `
            <tr class="hover:bg-gray-50 transition">
                    <td class="py-4 px-6">
                        <span class="font-semibold text-gray-900">${nomor}</span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-3">
                            <div>
                                <p class="font-semibold text-gray-900">${x.nama_layanan}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="${jenisColor} px-3 py-1 rounded-full text-xs font-bold">
                            ${x.jenis}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <p class="font-bold text-gray-900"> Rp ${(Number(x.harga)).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</p>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>

                            <span class="text-sm text-gray-900">
                                ${hari > 0 ? hari + ' hari ' : ''}${jam > 0 ? jam + ' jam' : ''}
                            </span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="${statusColor} px-3 py-1 rounded-full text-xs font-bold">
                            ${x.status}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-center space-x-2">
                            <button data-url="/layanan/${x.id_layanan}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="confirmDelete('${x.id_layanan}')" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>`;
        });
    } else {
        html = `<tr><td colspan="7" class="text-center py-4 text-gray-500">Data tidak ditemukan</td></tr>`;
    }

    $('#idBodyTableLayananLaundry').html(html);
}

function updateInfo(res) {
    // Update jumlah layanan
    $('#jumlahLayananInfo').html(
        `Menampilkan ${res.total} layanan`
    );

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
    fetchData(page); // panggil fetchData dengan page tertentu
});


// Event delegation untuk pagination
$(document).on('click', '.page-btn', function() {
    let page = $(this).data('page');
    fetchData(page);
});


// Debounce
// let timer;
// $('#searchInput').on('keyup', function() {
//     clearTimeout(timer);
//     let query = $(this).val();

//     timer = setTimeout(() => {
//         $.ajax({
//             url: '/layanan/search',
//             type: 'GET',
//             data: { q: query },
//             success: function(res) {
//                 updateTable(res);
//             },
//             error: function(err) {
//                 console.error(err);
//             }
//         });
//     }, 400);
// });

// Debounce
// let timer;
// function fetchData() {
//     clearTimeout(timer);
//     timer = setTimeout(() => {
//         let layanan = $('#searchInput').val();
//         let jenis = $('#filterJenis').val();
//         let harga = $('#filterHarga').val();

//         $.ajax({
//             url: '/layanan/search',
//             type: 'GET',
//             data: { layanan: layanan, jenis: jenis, harga: harga },
//             success: function(res) {
//                 updateTable(res);
//             },
//             error: function(err) {
//                 console.error(err);
//             }
//         });
//     }, 400);
// }

// // Event listener
// $('#searchInput').on('keyup', fetchData);
// $('#filterJenis').on('change', fetchData);
// $('#filterHarga').on('change', fetchData);

let timer;
function fetchData(page = 1) {
    clearTimeout(timer);
    timer = setTimeout(() => {
        let layanan = $('#searchInput').val();
        let jenis = $('#filterJenis').val();
        let harga = $('#filterHarga').val();

        $.ajax({
            url: '/layanan/search',
            type: 'GET',
            data: { layanan: layanan, jenis: jenis, harga: harga, page: page },
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
$('#searchInput, #filterJenis, #filterHarga').on('keyup change', () => fetchData());

</script>

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }
</script>
<script>
    function JustRunThisButton(){
        let nama_layanan = document.getElementById('id_nama_layanan').value;
        let jenis = document.getElementById('id_jenis').value;
        let harga = document.getElementById('id_harga').value;
        let durasi = document.getElementById('id_durasi').value;
        let status = document.getElementById('id_status').value;

        if(nama_layanan == '' || nama_layanan == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Nama Layanan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(jenis == '' || jenis == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Jenis Layanan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(durasi == '' || durasi == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Durasi!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(parseInt(durasi) <= 0) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap isi Durasi Pengerjaan dengan angka lebih dari 0!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if (harga == '' || harga == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Harga!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(status == '' || status == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Status!",
                timer:2000,
                timerProgressBar: true,
            });
        } else {
            $('.classCreateForm').trigger('submit');
        }
    }
</script>

<script>
    function JustRunThisButtonEdit(){
        let nama_layanan = document.getElementById('id_nama_layanan_edit').value;
        let jenis = document.getElementById('id_jenis_edit').value;
        let harga = document.getElementById('id_harga_edit').value;
        let durasi = document.getElementById('id_durasi_edit').value;
        let status = document.getElementById('id_status_edit').value;

        if(nama_layanan == '' || nama_layanan == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Nama Layanan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(jenis == '' || jenis == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Jenis Layanan!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(durasi == '' || durasi == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Durasi!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(parseInt(durasi) <= 0) {
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap isi Durasi Pengerjaan dengan angka lebih dari 0!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if (harga == '' || harga == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Harga!",
                timer:2000,
                timerProgressBar: true,
            });
        } else if(status == '' || status == null){
            Swal.fire({
                icon: "warning",
                confirmButtonColor: "#2600FF",
                title: "Peringatan",
                text: "Harap Isi Status!",
                timer:2000,
                timerProgressBar: true,
            });
        } else {
            $('.classEditForm_Edit').trigger('submit');
        }
    }
</script>
<script>
    function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data layanan akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6D28D9',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form delete
            document.getElementById('deleteForm' + id).submit();
        }
    });
}
</script>
@endsection

