<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Pelanggan Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan pelanggan</p>
    </div>
    <button onclick="closeCrudSubModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<form method="POST" id="idCreateSubForm" class="classCreateSubForm p-6 space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan *</label>
            <input type="text" name="nama" id="id_nama" placeholder="Contoh: Sabrina Anderson" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">No. Hp *</label>
            <input name="no_hp" id="id_no_hp" type="text" placeholder="Contoh: 081564874762" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
            <input type="email" name="email" id="id_email" placeholder="Contoh: sabrina018@example.com" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
        <textarea rows="3" name="alamat" id="id_alamat" placeholder="Contoh: 89 Pine Avenue, Seattle, Washington, USA" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500"></textarea>
    </div>

    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeCrudSubModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="button" onclick="JustRunThisButtonOrders()" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Simpan Pelanggan</span>
        </button>
    </div>
</form>
