<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function loginCustomer(){
        return view('auth.loginCustomer');
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
