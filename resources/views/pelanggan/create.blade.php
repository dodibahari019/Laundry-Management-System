<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Tambah Pelanggan Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan pelanggan</p>
    </div>
    <button onclick="closeCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<form action="/pelanggan" method="POST" id="idCreateFormPelanggan" class="classCreateForm pt-2 px-6 pb-6 space-y-6">
    @csrf

    <!-- Nama dan No HP -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
            <input type="text" name="nama" id="id_nama_pelanggan" placeholder="Contoh: Budi Setiawan"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">No HP *</label>
            <input type="text" name="no_hp" id="id_no_hp" placeholder="081234567890" maxlength="14"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
    </div>

    <!-- Email dan Alamat -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
            <input type="email" name="email" id="id_email" placeholder="contoh@email.com"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
            <textarea name="alamat" id="id_alamat" rows="3" style="resize: none;"
                placeholder="Masukkan alamat lengkap pelanggan"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500"></textarea>
        </div>
    </div>

    <!-- BUTTONS -->
    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeCrudModal()"
            class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="button" onclick="JustRunThisButtonPelanggan()"
            class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Simpan Pelanggan</span>
        </button>
    </div>
</form>

<script>
function JustRunThisButtonPelanggan() {
    // Ambil nilai field
    const nama = document.getElementById('id_nama_pelanggan').value.trim();
    const noHp = document.getElementById('id_no_hp').value.trim();
    const email = document.getElementById('id_email').value.trim();
    const alamat = document.getElementById('id_alamat').value.trim();

    // Validasi field wajib
    if (!nama) {
        alert('Nama wajib diisi!');
        document.getElementById('id_nama_pelanggan').focus();
        return;
    }
    if (!noHp) {
        alert('No HP wajib diisi!');
        document.getElementById('id_no_hp').focus();
        return;
    }
    if (!email) {
        alert('Email wajib diisi!');
        document.getElementById('id_email').focus();
        return;
    }
    if (!alamat) {
        alert('Alamat wajib diisi!');
        document.getElementById('id_alamat').focus();
        return;
    }

    // Jika semua valid, submit form
    document.getElementById('idCreateFormPelanggan').submit();
}
</script>