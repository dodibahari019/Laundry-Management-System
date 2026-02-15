<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Pengeluaran Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan pengeluaran</p>
    </div>
    <button onclick="closeCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<form action="/pengeluaran" method="POST" id="idCreateForm" class="classCreateForm p-6 space-y-6">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengeluaran *</label>
            <input type="text" name="nama_pengeluaran" id="id_nama_pengeluaran" placeholder="Contoh: Pembelian Detergen"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengeluaran *</label>
            <input type="date" name="tanggal_pengeluaran" id="id_tanggal_pengeluaran" value="{{ date('Y-m-d') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
            <select name="kategori" id="id_kategori"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <option value="">-- Pilih Kategori --</option>
                <option value="operasional">Operasional</option>
                <option value="peralatan">Peralatan</option>
                <option value="bahan">Bahan Baku</option>
                <option value="gaji">Gaji Karyawan</option>
                <option value="utilitas">Utilitas (Listrik, Air)</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah (Rp) *</label>
            <div class="relative">
                <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                <input name="jumlah" id="id_jumlah" type="text" placeholder="0"
                    class="classRp w-full pl-12 text-right pr-6 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeCrudModal()"
            class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="button" onclick="JustRunThisButton()"
            class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            <span>Simpan</span>
        </button>
    </div>
</form>