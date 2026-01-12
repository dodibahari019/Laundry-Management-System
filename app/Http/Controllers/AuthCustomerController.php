<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthCustomerController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.customer-login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
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

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/customer-login')->with('success', 'Anda telah logout.');
    }
}
