<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Layanan Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan layanan</p>
    </div>
    <button onclick="closeCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<form class="p-6 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan *</label>
            <input type="text" placeholder="Contoh: Cuci Sepatu" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan *</label>
            <select class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <option value="">-- Pilih Jenis --</option>
                <option>Kiloan</option>
                <option>Satuan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Pengerjaan *</label>
            <div class="flex space-x-3">
                <input type="text" placeholder="0" class="classRp text-right flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                <select disabled class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option>Jam</option>
                    <option>Hari</option>
                </select>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
            <div class="relative">
                <span class="absolute left-4 top-3 text-gray-500 font-medium">Rp</span>
                <input type="text" placeholder="0" class="classRp w-full pl-12 text-right pr-6 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
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

    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeCrudModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="submit" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Simpan Layanan</span>
        </button>
    </div>
</form>