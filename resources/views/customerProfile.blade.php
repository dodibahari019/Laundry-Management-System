<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - D`Laundry</title>
    <link rel="icon" href="{{ asset('image/LogoDLaundry.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .tab-button {
            position: relative;
            padding: 12px 24px;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s;
        }

        .tab-button.active {
            color: #667eea;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 3px 3px 0 0;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .input-with-icon {
            padding-left: 48px;
        }
    </style>
</head>
<body class="bg-gray-50">

    @include('landingPageComponent.navbar')

    <!-- Main Content -->
    <section class="pt-32 pb-24 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="mb-8 fade-in">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    Profil <span class="gradient-text">Saya</span>
                </h1>
                <p class="text-gray-600 text-lg">Kelola informasi pribadi dan keamanan akun Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                
                <!-- Sidebar Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 fade-in">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 gradient-primary rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
                                {{ strtoupper(substr($customer->first_name ?? $customer->nama, 0, 1)) }}{{ strtoupper(substr($customer->last_name ?? '', 0, 1)) }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $customer->nama }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $customer->email }}</p>
                            
                            @if($customer->email_verified_at)
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold mt-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Email Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold mt-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Belum Verifikasi
                            </span>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $customer->no_hp }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                {{ $customer->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Bergabung {{ \Carbon\Carbon::parse($customer->created_at)->format('M Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden fade-in">
                        
                        <!-- Tabs Header -->
                        <div class="border-b border-gray-200 px-8">
                            <div class="flex space-x-8">
                                <button class="tab-button active" data-tab="profile">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Informasi Profil
                                    </div>
                                </button>
                                <button class="tab-button" data-tab="password">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Keamanan
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Tab Contents -->
                        <div class="p-8">
                            
                            <!-- Profile Tab -->
                            <div class="tab-content active" id="profile-tab">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Pribadi</h2>
                                
                                <form id="profileForm" class="space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- First Name -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Depan</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <input type="text" name="first_name" value="{{ $customer->first_name }}" 
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Belakang</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <input type="text" name="last_name" value="{{ $customer->last_name }}" 
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <input type="email" name="email" value="{{ $customer->email }}" 
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Telepon</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                <input type="text" name="no_hp" value="{{ $customer->no_hp }}" 
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                                <select name="gender" 
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required>
                                                    <option value="L" {{ $customer->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P" {{ $customer->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Kategori Alamat -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Alamat</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                                <select name="kategori_alamat" 
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition">
                                                    <option value="rumah" {{ $customer->kategori_alamat == 'rumah' ? 'selected' : '' }}>Rumah</option>
                                                    <option value="kost" {{ $customer->kategori_alamat == 'kost' ? 'selected' : '' }}>Kost</option>
                                                    <option value="kantor" {{ $customer->kategori_alamat == 'kantor' ? 'selected' : '' }}>Kantor</option>
                                                    <option value="hotel" {{ $customer->kategori_alamat == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                                        <textarea name="alamat" rows="4" 
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                            required>{{ $customer->alamat }}</textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end pt-4">
                                        <button type="submit" class="gradient-primary text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Password Tab -->
                            <div class="tab-content" id="password-tab">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ubah Password</h2>
                                
                                <div class="max-w-2xl">
                                    <div class="bg-blue-50 border-2 border-blue-200 rounded-2xl p-6 mb-6">
                                        <div class="flex items-start gap-3">
                                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <h4 class="font-bold text-blue-900 mb-1">Tips Keamanan Password</h4>
                                                <ul class="text-sm text-blue-800 space-y-1">
                                                    <li>• Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                                                    <li>• Minimal 8 karakter</li>
                                                    <li>• Jangan gunakan password yang mudah ditebak</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="passwordForm" class="space-y-6">
                                        @csrf
                                        @method('PUT')

                                        <!-- Current Password -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- New Password -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                                </svg>
                                                <input type="password" name="new_password" id="new_password"
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required minlength="8">
                                            </div>
                                        </div>

                                        <!-- Confirm New Password -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                            <div class="input-group">
                                                <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                                    class="input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition"
                                                    required minlength="8">
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="flex justify-end pt-4">
                                            <button type="submit" class="gradient-primary text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg">
                                                Ubah Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('landingPageComponent.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tab Switching
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and contents
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                const tabId = button.getAttribute('data-tab');
                document.getElementById(tabId + '-tab').classList.add('active');
            });
        });

        // Profile Form Submit
        document.getElementById('profileForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            try {
                const response = await fetch('{{ route("customer.profile.update") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#667eea',
                        timer: 2000,
                        timerProgressBar: true,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan saat memperbarui profil',
                    confirmButtonColor: '#667eea',
                });
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });

        // Password Form Submit
        document.getElementById('passwordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;
            
            // Validate password match
            if (newPassword !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok!',
                    text: 'Password baru dan konfirmasi password tidak sama',
                    confirmButtonColor: '#667eea',
                });
                return;
            }
            
            const formData = new FormData(this);
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            try {
                const response = await fetch('{{ route("customer.password.update") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#667eea',
                        timer: 2000,
                        timerProgressBar: true,
                    }).then(() => {
                        this.reset();
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan saat mengubah password',
                    confirmButtonColor: '#667eea',
                });
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });
    </script>
</body>
</html>