<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>D`Laundry | Login</title>
    <!-- Favicon -->
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
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

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        @keyframes particle-float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-100px) translateX(50px);
                opacity: 0.6;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen py-20 flex items-center justify-center relative">

    <!-- Background Particles -->
    <div class="absolute inset-0">
        <div class="particle w-20 h-20 bg-purple-300 opacity-20 top-10 left-10" style="animation: particle-float 6s ease-in-out infinite;"></div>
        <div class="particle w-32 h-32 bg-blue-300 opacity-20 top-40 right-20" style="animation: particle-float 8s ease-in-out infinite 1s;"></div>
        <div class="particle w-24 h-24 bg-purple-300 opacity-20 bottom-20 left-1/4" style="animation: particle-float 7s ease-in-out infinite 2s;"></div>
        <div class="particle w-16 h-16 bg-blue-300 opacity-20 bottom-40 right-1/3" style="animation: particle-float 5s ease-in-out infinite 3s;"></div>
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid md:grid-cols-2 gap-8 items-center">

            <!-- Left Side - Branding -->
            <div class="hidden md:block fade-in">
                <div class="text-center mb-10">
                    <div class="flex items-center justify-center space-x-3 mb-6">
                        <div class="w-20 h-20 flex items-center justify-center floating">
                            <img src="image/LogoDLaundry.png" alt="D`Laundry" class="h-20 w-auto opacity-80">
                        </div>
                        <span class="text-5xl font-extrabold text-gray-900">D`Laundry</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="fade-in">
                <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100">
                    <!-- Mobile Logo -->
                    <div class="md:hidden text-center mb-8">
                        <div class="flex items-center justify-center space-x-3 mb-4">
                            <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-extrabold text-gray-900">D`Laundry</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang!</h2>
                        <p class="text-gray-600">Masuk ke akun karyawan Anda untuk melanjutkan</p>
                    </div>

                    <!-- Alert Message -->
                    <div id="alertMessage" class="hidden mb-4 p-4 rounded-xl"></div>

                    <form id="formLogin" class="space-y-6">
                        @csrf
                        <!-- Username Input -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder="Masukkan email"
                                    class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-base"
                                >
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    class="w-full pl-12 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-base"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600"
                                >
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        

                        <!-- Login Button -->
                        <button
                            type="submit"
                            id="btnLogin"
                            class="w-full gradient-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:opacity-90 transition shadow-xl flex items-center justify-center gap-3"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Masuk
                        </button>

                        <!-- Divider -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500 font-medium">atau</span>
                            </div>
                        </div>

                        <!-- Back to Home -->
                        <a
                            href="/"
                            class="w-full bg-gray-100 text-gray-700 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-200 transition shadow-lg flex items-center justify-center gap-3"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Setup CSRF Token untuk semua AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                `;
            }
        }

        // Handle Login Form Submit
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();

            const username = $('#username').val().trim();
            const password = $('#password').val().trim();
            const btnLogin = $('#btnLogin');
            const originalBtnText = btnLogin.html();

            // Validasi client-side
            if (!username) {
                showAlert('error', 'Username wajib diisi!');
                return;
            }

            if (!password) {
                showAlert('error', 'Password wajib diisi!');
                return;
            }

            // Loading state
            btnLogin.html(`
                <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Memproses...</span>
            `).prop('disabled', true);

            // AJAX Login Request
            $.ajax({
                url: '/login',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: true,
                            confirmButtonColor: "#6D28D9",
                            timerProgressBar: true,
                            timer: 1500
                        }).then(() => {
                            // Redirect ke halaman yang ditentukan
                            window.location.href = response.redirect;
                        });
                    } else {
                        // Reset button
                        btnLogin.html(originalBtnText).prop('disabled', false);
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    // Reset button
                    btnLogin.html(originalBtnText).prop('disabled', false);

                    let errorMessage = 'Terjadi kesalahan pada server';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    showAlert('error', errorMessage);
                }
            });
        });

        // Function untuk menampilkan alert
        function showAlert(type, message) {
            const alertDiv = $('#alertMessage');

            if (type === 'error') {
                alertDiv.removeClass('bg-green-100 border-green-400 text-green-700')
                        .addClass('bg-red-100 border-l-4 border-red-400 text-red-700');
            } else {
                alertDiv.removeClass('bg-red-100 border-red-400 text-red-700')
                        .addClass('bg-green-100 border-l-4 border-green-400 text-green-700');
            }

            alertDiv.html(`
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">${message}</span>
                </div>
            `).removeClass('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                alertDiv.addClass('hidden');
            }, 5000);
        }

        // Enter key untuk submit
        $('#username, #password').on('keypress', function(e) {
            if (e.which === 13) {
                $('#formLogin').submit();
            }
        });
    </script>
</body>
</html>
