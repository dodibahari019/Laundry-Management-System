@extends('layouts.frame')
@section('Title', 'Pengeluaran Operasional')
@section('CssSection')

@endsection
@section('HeaderTitle', 'Pengeluaran Operasional')
@section('Description', 'Kelola data pengeluaran operasional laundry seperti bahan baku, peralatan, dan utilitas')
@section('MainContentArea')
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-2xl p-6 mb-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pengeluaran</label>
                <div class="relative">
                    <input id="searchInput" type="text" placeholder="Cari nama pengeluaran..."
                        class="h-12 w-full pl-10 pr-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">

                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select id="filterKategori"
                    class="h-12 w-full px-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="">Semua Kategori</option>
                    <option value="operasional">Operasional</option>
                    <option value="peralatan">Peralatan</option>
                    <option value="bahan">Bahan Baku</option>
                    <option value="gaji">Gaji Karyawan</option>
                    <option value="utilitas">Utilitas</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Button Add -->
            <div class="flex items-end md:col-span-1">
                <button data-url="/pengeluaran/create"
                    class="modal-crud h-12 w-full gradient-primary text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div
            class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Table Pengeluaran -->
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Daftar Pengeluaran</h2>
                <p id="jumlahPengeluaranInfo" class="text-sm text-gray-500 mt-1">Menampilkan {{ $pengeluaran->count() }}
                    pengeluaran</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            @include('pengeluaran.table')
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
        // VALIDASI CREATE
        // ========================================
        function JustRunThisButton() {
            let nama_pengeluaran = $('#id_nama_pengeluaran').val().trim();
            let kategori = $('#id_kategori').val();
            let jumlah = $('#id_jumlah').val().trim();
            let tanggal_pengeluaran = $('#id_tanggal_pengeluaran').val();

            // Remove format Rupiah untuk validasi
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

            // Submit form
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

            // Remove format Rupiah untuk validasi
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

            // Submit form
            $('.classEditForm_Edit').submit();
        }

        // ========================================
        // FILTER TABLE
        // ========================================
        let timer;

        function filterTable() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                const searchValue = document.getElementById('searchInput').value.toLowerCase();
                const kategoriValue = document.getElementById('filterKategori').value.toLowerCase();
                const rows = document.querySelectorAll('#pengeluaranTable tbody tr');
                let visibleCount = 0;

                rows.forEach(row => {
                    const nama = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                    const kategori = row.getAttribute('data-kategori') || '';

                    const matchSearch = nama.includes(searchValue);
                    const matchKategori = kategoriValue === '' || kategori === kategoriValue;

                    if (matchSearch && matchKategori) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                document.getElementById('jumlahPengeluaranInfo').textContent =
                    `Menampilkan ${visibleCount} pengeluaran`;
            }, 400);
        }

        // Event listener
        document.getElementById('searchInput').addEventListener('keyup', filterTable);
        document.getElementById('filterKategori').addEventListener('change', filterTable);

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