<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function loginCustomer(){
        return view('auth.loginCustomer');
    }

     /**
     * Handle login request
     */
    public function cistomerogin(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            // Cari pelanggan berdasarkan email
            $pelanggan = Pelanggan::where('email', $request->email)->first();

            // Cek apakah email terdaftar
            if (!$pelanggan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah!'
                ], 401);
            }

            // Cek auth provider
            if ($pelanggan->auth_provider === 'google') {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda terdaftar menggunakan Google. Silakan login dengan Google.',
                    'use_google' => true
                ], 401);
            }

            // Cek password
            if (!Hash::check($request->password, $pelanggan->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah!'
                ], 401);
            }

            // 🔥 GUARD: Cek apakah email sudah diverifikasi
            if (!$pelanggan->hasVerifiedEmail()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email Anda belum diverifikasi. Silakan cek inbox email Anda atau klik tombol "Kirim Ulang Verifikasi".',
                    'email_not_verified' => true,
                    'email' => $pelanggan->email
                ], 403);
            }

            // 🔥 GUARD: Cek status akun
            if (!$pelanggan->isActive()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda tidak aktif. Silakan hubungi admin.'
                ], 403);
            }

            // Login berhasil
            Auth::guard('pelanggan')->login($pelanggan, $request->remember ?? false);

            // Update last login (opsional)
            $pelanggan->update([
                'last_login_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Selamat datang ' . $pelanggan->nama,
                'redirect' => route('customer.dashboard') // Sesuaikan dengan route dashboard kamu
            ]);

        } catch (\Exception $e) {
            \Log::error('Error during login: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat login. Silakan coba lagi.'
            ], 500);
        }
    }

    public function register(){
        return view('auth.registerCustomer');
    }

    public function login(Request $request)
    {
        try {
            // Validasi input
            $data = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ], [
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]);

            // Cari user berdasarkan username
            $user = Users::where('username', $data['username'])->first();

            // Validasi user dan password
            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Username atau password salah.',
                ], 401);
            }

            // Ambil role
            $role = $user->role ?? 'unknown';

            // Login dan simpan session
            Auth::login($user);
            $request->session()->regenerate();

            // Simpan data ke session
            session([
                'id_user'  => $user->id_user,
                'username' => $user->username,
                'nama'     => $user->nama,
                'email'    => $user->email,
                'role'     => $role,
            ]);

            // Redirect berdasarkan role
            $redirectMap = [
                'admin'    => '/dashboard',
                'kasir'    => '/orders',
                'petugas' => '/orders',
            ];
            $redirectUrl = $redirectMap[$role] ?? '/dashboard';

            return response()->json([
                'success'  => true,
                'message'  => 'Login berhasil! Selamat datang!!!',
                'redirect' => url($redirectUrl),
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout');
    }

    /**
     * Check apakah user sudah login (untuk AJAX)
     */
    public function checkAuth()
    {
        if (Auth::check()) {
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id'       => Auth::user()->id_user,
                    'username' => Auth::user()->username,
                    'nama'     => Auth::user()->nama,
                    'role'     => Auth::user()->role,
                ]
            ]);
        }

        return response()->json([
            'authenticated' => false
        ], 401);
    }
}
