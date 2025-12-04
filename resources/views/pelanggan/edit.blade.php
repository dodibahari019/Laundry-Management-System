<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Pelanggan</h2>
        <p class="text-sm text-gray-500 mt-1">Perbarui informasi pelanggan</p>
    </div>
    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<form method="POST" id="formEditPelanggan" class="p-6 space-y-6">
    @csrf
    @method("PUT")

    <!-- Nama + No HP -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- NAMA -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
            <input type="text" name="nama" id="edit_nama" class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                       focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <!-- NO HP -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">No HP *</label>
            <input type="text" name="no_hp" id="edit_no_hp" maxlength="14"
                oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,14)" class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                       focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>

    <!-- Email + Alamat -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- EMAIL -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
            <input type="email" name="email" id="edit_email" class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                       focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <!-- ALAMAT -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
            <textarea name="alamat" id="edit_alamat" rows="3" style="resize:none;" class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                         focus:ring-2 focus:ring-purple-100 focus:border-purple-500"></textarea>
        </div>
    </div>
    <!-- BUTTONS -->
    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeEditModal()"
            class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>

        <button type="submit"
            class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Update Pelanggan</span>
        </button>
    </div>
</form>