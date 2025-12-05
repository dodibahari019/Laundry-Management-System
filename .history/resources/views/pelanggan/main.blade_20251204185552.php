@extends('layouts.frame')
@section('Title', 'Pelanggan')
@section('CssSection')

@endsection
@section('HeaderTitle', 'Pelanggan')
@section('Description', 'Kelola informasi pelanggan yang terdaftar di sistem')
@section('MainContentArea')
<!-- Filter & Search Section -->
<div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pelanggan</label>
            <div class="relative">
                <input type="text" placeholder="Cari nama, no hp, alamat..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Filter Jenis -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
            <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <option value="">Default</option>
                <option value="terbaru">Terbaru</option>
                <option value="terlama">Terlama</option>
                <option value="nama_asc">Nama A-Z</option>
                <option value="nama_desc">Nama Z-A</option>
            </select>
        </div>

        <!-- BUTTON TAMBAH -->
        <div class=" flex items-end">
            <button data-url="/pelanggan/create"
                class="modal-crud w-full px-4 py-2.5 gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Tambah</span>
            </button>
        </div>

    </div>

    <!-- FORM UNTUK SEARCH & SORT -->
    <form id="formFilter" method="GET" action="/pelanggan"></form>
</div>

<!-- Table Pelanggan -->
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        @include('pelanggan.table')
    </div>

    <!-- Pagination -->
    <div class="p-6 border-t border-gray-200 flex items-center justify-between">
        <div id="jumlahPelangganInfo" class="text-sm text-gray-600">
            Menampilkan {{ $dataPelanggan->count() }} dari {{ $jumlahSemua }} pelanggan
        </div>
        <div id="paginationContainer" class="flex space-x-2">

            {{-- Previous --}}
            @if($dataPelanggan->onFirstPage())
            <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">
                Previous
            </button>
            @else
            <button data-page="{{ $dataPelanggan->currentPage() - 1 }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">
                Previous
            </button>
            @endif

            {{-- Page numbers --}}
            @foreach ($dataPelanggan->getUrlRange(1, $dataPelanggan->lastPage()) as $page => $url)
            <button data-page="{{ $page }}"
                class="px-3 py-2 rounded-lg text-sm font-semibold 
                                                                            {{ $dataPelanggan->currentPage() == $page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50' }}">
                {{ $page }}
            </button>
            @endforeach

            {{-- Next --}}
            @if($dataPelanggan->hasMorePages())
            <button data-page="{{ $dataPelanggan->currentPage() + 1 }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">
                Next
            </button>
            @else
            <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">
                Next
            </button>
            @endif

        </div>
    </div>

    <!-- Modal Edit Pelanggan -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                @include('pelanggan.edit')
            </div>

        </div>
    </div>
    </form>
</div>
</div>
@endsection
@section('JavascriptSection')
<script>
// validasi untuk create pelanggan
function JustRunThisButtonPelanggan() {
    let nama = document.getElementById('id_nama_pelanggan').value.trim();
    let hp = document.getElementById('id_no_hp').value.trim();
    let email = document.getElementById('id_email').value.trim();
    let alamat = document.getElementById('id_alamat').value.trim();
    if (nama == '' || nama == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi Nama Pelanggan!",
            timer: 2000,
            timerProgressBar: true,
        });
    } else if (hp == '' || hp == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi No HP!",
            timer: 2000,
            timerProgressBar: true,
        });
    } else if (email == '' || email == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi Email!",
            timer: 2000,
            timerProgressBar: true,
        });
    } else if (alamat == '' || alamat == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi Alamat!",
            timer: 2000,
            timerProgressBar: true,
        });
    } else {
        document.getElementById('idCreateFormPelanggan').submit();
    }
}

function updateTable(res) {
    let html = '';

    if (res.data.length > 0) {
        res.data.forEach((x, index) => {
            let nomor = (res.current_page - 1) * res.per_page + index + 1;

            html += `
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="py-4 px-6 text-center">${nomor}</td>
                                                <td class="py-4 px-6">${x.nama}</td>
                                                <td class="py-4 px-6">${x.no_hp}</td>
                                                <td class="py-4 px-6">${x.email}</td>
                                                <td class="py-4 px-6">${x.alamat}</td>
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <button class="text-green-600 hover:text-green-800 p-1"
                                                            onclick="openEditModalPelanggan('${x.id_pelanggan}','${x.nama}','${x.no_hp}','${x.email}','${x.alamat}')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                        </button>
                                                        <button onclick="confirmDelete('${x.id_pelanggan}')"
                                                                class="text-red-600 hover:text-red-800 p-1">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>`;
        });
    } else {
        html = `
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-gray-500">
                                                Data tidak ditemukan
                                            </td>
                                        </tr>`;
    }

    document.getElementById('idBodyTablePelanggan').innerHTML = html;
}

// Update info jumlah pelanggan
function updateInfo(res) {
    document.getElementById('jumlahPelangganInfo').innerHTML =
        `Menampilkan ${res.total} pelanggan`;
}

// Update pagination 
function updatePagination(res) {
    let html = '';

    html += `
                                        <button data-page="${res.current_page - 1}"
                                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50
                                            ${res.current_page == 1 ? 'opacity-50' : ''}"
                                            ${res.current_page == 1 ? 'disabled' : ''}>
                                            Previous
                                        </button>`;

    for (let i = 1; i <= res.last_page; i++) {
        html += `
                                        <button data-page="${i}"
                                            class="px-3 py-2 rounded-lg text-sm font-semibold
                                            ${res.current_page == i ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50'}">
                                            ${i}
                                        </button>`;
    }

    html += `
                                        <button data-page="${res.current_page + 1}"
                                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50
                                            ${res.current_page == res.last_page ? 'opacity-50' : ''}"
                                            ${res.current_page == res.last_page ? 'disabled' : ''}>
                                            Next
                                        </button>`;

    $('#paginationContainer').html(html);
}

// Fetch data dengan debounce
let timer;

function fetchData(page = 1) {
    clearTimeout(timer);
    timer = setTimeout(() => {
        let search = document.getElementById('searchPelanggan').value;
        let sort = document.getElementById('sortSelect').value;

        $.ajax({
            url: '/pelanggan/search',
            type: 'GET',
            data: {
                search: search,
                sort: sort,
                page: page
            },
            success: function(res) {
                updateTable(res);
                updateInfo(res);
                updatePagination(res);
            },
            error: function(err) {
                console.error(err);
            }
        });
    }, 400);
}

// Event listener untuk search
$('#searchPelanggan').on('keyup', () => fetchData());
$('#sortSelect').on('change', () => fetchData());
$('#searchPelanggan').on('keypress', function(e) {
    if (e.which == 13) {
        e.preventDefault();
    }
});
// Event delegation untuk pagination
$(document).on('click', '#paginationContainer button[data-page]', function() {
    let page = $(this).data('page');
    fetchData(page);
});

// Fungsi modal edit
function openEditModalPelanggan(id, nama, hp, email, alamat) {
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_no_hp").value = hp;
    document.getElementById("edit_email").value = email;
    document.getElementById("edit_alamat").value = alamat;
    document.getElementById("formEditPelanggan").action = "/pelanggan/" + id;
    document.getElementById("editModal").classList.remove("hidden");
}

function closeEditModal() {
    console.log('Closing edit modal');
    const modal = document.getElementById("editModal");
    if (modal) {
        modal.classList.add("hidden");
    } else {
        console.error('Modal edit not found');
    }
}
//event listener untuk tombol close 
document.addEventListener('DOMContentLoaded', function() {
    const formEdit = document.getElementById('formEditPelanggan');
    if (formEdit) {
        formEdit.addEventListener('submit', function(e) {
            let nama = document.getElementById("edit_nama")?.value.trim();
            let hp = document.getElementById("edit_no_hp").value.trim();
            let email = document.getElementById("edit_email").value.trim();
            let alamat = document.getElementById("edit_alamat").value.trim();

            if (nama == '' || nama == null) {
                e.preventDefault();
                Swal.fire({
                    icon: "warning",
                    confirmButtonColor: "#2600FF",
                    title: "Peringatan",
                    text: "Harap Isi Nama Pelanggan!",
                    timer: 2000,
                    timerProgressBar: true,
                });
            } else if (hp == '' || hp == null) {
                e.preventDefault();
                Swal.fire({
                    icon: "warning",
                    confirmButtonColor: "#2600FF",
                    title: "Peringatan",
                    text: "Harap Isi No HP!",
                    timer: 2000,
                    timerProgressBar: true,
                });
            } else if (email == '' || email == null) {
                e.preventDefault();
                Swal.fire({
                    icon: "warning",
                    confirmButtonColor: "#2600FF",
                    title: "Peringatan",
                    text: "Harap Isi Email!",
                    timer: 2000,
                    timerProgressBar: true,
                });
            } else if (alamat == '' || alamat == null) {
                e.preventDefault();
                Swal.fire({
                    icon: "warning",
                    confirmButtonColor: "#2600FF",
                    title: "Peringatan",
                    text: "Harap Isi Alamat!",
                    timer: 2000,
                    timerProgressBar: true,
                });
            }
            // Jika semua valid, form submit otomatis
        });
    }
});

// Fungsi validasi edit
function JustRunThisButtonEditPelanggan() {
    console.log('Edit validation triggered');

    let nama = document.getElementById("edit_nama")?.value.trim();
    let hp = document.getElementById("edit_no_hp").value.trim();
    let email = document.getElementById("edit_email").value.trim();
    let alamat = document.getElementById("edit_alamat").value.trim();

    if (nama == '' || nama == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi Nama Pelanggan!",
            timer: 2000,
            timerProgressBar: true,
        });
        return false;
    } else if (hp == '' || hp == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi No HP!",
            timer: 2000,
            timerProgressBar: true,
        });
        return false;
    } else if (email == '' || email == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi Email!",
            timer: 2000,
            timerProgressBar: true,
        });
        return false;
    } else if (alamat == '' || alamat == null) {
        Swal.fire({
            icon: "warning",
            confirmButtonColor: "#2600FF",
            title: "Peringatan",
            text: "Harap Isi Alamat!",
            timer: 2000,
            timerProgressBar: true,
        });
        return false;
    } else {
        document.getElementById("formEditPelanggan").submit();
    }
}
// Fungsi konfirmasi delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data pelanggan akan dihapus permanen!",
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