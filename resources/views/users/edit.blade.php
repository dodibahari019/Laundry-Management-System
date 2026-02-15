<div class="p-6 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Edit Data Users</h2>
        <p class="text-sm text-gray-500 mt-1">Edit form di bawah untuk mengubah data users</p>
    </div>
    <button onclick="closeCrudModal()" class="text-gray-400 hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@foreach($dataUsersById as $x)
    <form action="/users/{{ $x->id_user }}" method="POST" autocomplete="off" id="idEditFormUsers" class="classEditForm p-6 space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Username *</label>
                <input value="{{ $x->username }}" name="username" id="id_username_edit" type="text" autocomplete="off" placeholder="Contoh: Admin123" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                <input value="{{ $x->nama }}" name="nama" id="id_nama_edit" type="text" placeholder="Contoh: Harry Brown" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input value="{{ $x->email }}" name="email" id="id_email_edit" type="email" placeholder="Contoh: harry19@example.com" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                <input name="password" id="id_password_edit" type="password" autocomplete="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
            </div>
        </div>
        <div class="grid gird-cols-1 md:grid-cols-1 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                <select name="role" id="id_role_edit" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-100 focus:border-purple-500">
                    <option value="{{ $x->role }}" selected>{{ $x->role }}</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
            <button type="button" onclick="closeCrudModal()" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                Batal
            </button>
            <button type="button" onclick="ValidateEditUsers()" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center space-x-2">
                {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg> --}}
                <span>Simpan</span>
            </button>
        </div>
    </form>
@endforeach