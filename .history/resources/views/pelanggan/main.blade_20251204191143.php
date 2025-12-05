@extends('layouts.frame')
@section('Title', 'Pelanggan')
@section('CssSection')

@endsection
@section('HeaderTitle', 'Pelanggan')
@section('Description', 'Kelola informasi pelanggan yang terdaftar di sistem')
@section('MainContentArea')
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
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
                <h2 class="text-xl font-bold text-gray-900">Daftar Pelanggan</h2>
                <p id="jumlahPelangganInfo" class="text-sm text-gray-500 mt-1">Menampilkan {{ $jumlahSemua }} pelanggan aktif</p>
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
            @include('pelanggan.table')
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                {{-- Menampilkan <span class="font-semibold">1-6</span> dari <span class="font-semibold">18</span> layanan --}}
            </div>
            <div id="paginationContainerUsers" class="flex space-x-2">
                @if($dataPelanggan->onFirstPage())
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Previous</button>
                @else
                    <button data-page="{{ $dataPelanggan->currentPage() - 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Previous</button>
                @endif

                @foreach ($dataPelanggan->getUrlRange(1, $dataPelanggan->lastPage()) as $page => $url)
                    <button data-page="{{ $page }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ $dataPelanggan->currentPage() == $page ? 'bg-purple-600 text-white' : 'border text-gray-600 hover:bg-gray-50' }}">
                        {{ $page }}
                    </button>
                @endforeach

                @if($dataPelanggan->hasMorePages())
                    <button data-page="{{ $dataPelanggan->currentPage() + 1 }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Next</button>
                @else
                    <button disabled class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 opacity-50">Next</button>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('JavascriptSection')
<script>
    function updateTableUsers(res) {
        let html = '';

        if (res.data && res.data.length > 0) {
            res.data.forEach((x, index) => {
                // Nomor urut
                let nomor = (res.current_page - 1) * res.per_page + index + 1;

                let roleUsers = x.role;
                let statusColor = 'bg-purple-100 text-purple-700';
                if(roleUsers == 'admin'){
                    statusColor = 'bg-purple-100 text-purple-700';
                } else if(roleUsers == 'kasir'){
                    statusColor = 'bg-green-100 text-green-700';
                } else {
                    statusColor = 'bg-red-100 text-red-700';
                }

                html += `
                <tr class="border-b">
                    <td class="py-4 px-6">
                        <span class="font-semibold text-gray-900">${nomor}}</span>
                    </td>
                    <td class="py-4 px-6 text-gray-900">${p.nama}</td>
                    <td class="py-4 px-6 text-gray-900">${p.no_hp}</td>
                    <td class="py-4 px-6 text-gray-900">${p.email}</td>
                    <td class="py-4 px-6 text-gray-900">${p.alamat}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-center space-x-2">
                            <button data-url="/pelanggan/${p.id_pelanggan}/edit" class="modal-crud text-green-600 hover:text-green-800 p-1" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form id="deleteForm${p.id_pelanggan}" action="/pelanggan/${p.id_pelanggan}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button onclick="confirmDelete('${p.id_pelanggan}', this)" class="text-red-600 hover:text-red-800 p-1" title="Hapus">
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

        $('#idBodyTablePelanggan').html(html);
    }

    function updateInfoUsers(res) {
        // Update jumlah layanan
        $('#jumlahPelangganInfo').html(
            `Menampilkan ${res.total} Pelanggan Aktif`
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

        $('#paginationContainerUsers').html(paginationHtml);
    }

    // Event delegation untuk pagination
    $(document).on('click', '#paginationContainerUsers button[data-page]', function() {
        let page = $(this).data('page');
        fetchData(page); // panggil fetchData dengan page tertentu
    });


    // Event delegation untuk pagination
    $(document).on('click', '.page-btn', function() {
        let page = $(this).data('page');
        fetchData(page);
    });

    let timer;
    function fetchData(page = 1) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let users = $('#searchInput').val();
            let role = $('#filterRole').val();

            $.ajax({
                url: '/users/search',
                type: 'GET',
                data: { users: users, role: role, page: page },
                success: function(res) {
                    updateTableUsers(res);
                    updateInfoUsers(res);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }, 400);
    }

    // Event listener
    $('#searchInput, #filterRole').on('keyup change', () => fetchData());
</script>
<script>
    function ValidateCreateUsers() {
        let username = document.getElementById('id_username').value;
        let nama = document.getElementById('id_nama').value;
        let email = document.getElementById('id_email').value;
        let password = document.getElementById('id_password').value;
        let role = document.getElementById('id_role').value;

        if (username === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Username!",
                timer: 2000,
                timerProgressBar: true
            });
        }else if (nama === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Nama!",
                timer: 2000,
                timerProgressBar: true
            });
        }else if ((email === "")) {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap isi Email!",
                timer: 2000,
                timerProgressBar: true
            });
        }else if (password === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Password!",
                timer: 2000,
                timerProgressBar: true
            });
        }else if (role === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap isi Role!",
                timer: 2000,
                timerProgressBar: true
            });
        } else {
            document.getElementById('idCreateFormUsers').submit();
        }
    }

    function ValidateEditUsers() {
        let username = document.getElementById('id_username_edit').value;
        let nama = document.getElementById('id_nama_edit').value;
        let email = document.getElementById('id_email_edit').value;
        let password = document.getElementById('id_password_edit').value;
        let role = document.getElementById('id_role_edit').value;

        if (username === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Username!",
                timer: 2000,
                timerProgressBar: true
            });
        }else if (nama === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap Isi Nama!",
                timer: 2000,
                timerProgressBar: true
            });
        }else if ((email === "")) {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap isi Email!",
                timer: 2000,
                timerProgressBar: true
            });
        // }else if (password === "") {
        //     return Swal.fire({
        //         icon: "warning",
        //         confirmButtonColor: "#6D28D9",
        //         title: "Peringatan",
        //         text: "Harap Isi Password!",
        //         timer: 2000,
        //         timerProgressBar: true
        //     });
        }else if (role === "") {
            return Swal.fire({
                icon: "warning",
                confirmButtonColor: "#6D28D9",
                title: "Peringatan",
                text: "Harap isi Role!",
                timer: 2000,
                timerProgressBar: true
            });
        } else {
            document.getElementById('idEditFormUsers').submit();
        }
    }
</script>
<script>
    function confirmDeleteUsers(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data users akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6D28D9',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form delete
            document.getElementById('deleteFormUsers' + id).submit();
        }
    });
}
</script>
@endsection

