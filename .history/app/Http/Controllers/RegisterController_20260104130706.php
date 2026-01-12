<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\EmailVerification;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
     /**
     * Show register form
     */
    public function showRegisterForm()
    {
        return view('auth.registerCustomer');
    }

    /**
     * Handle register request
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:tb_pelanggan,email',
            'no_hp' => 'required|regex:/^08[0-9]{8,11}$/',
            'alamat' => 'required|string|min:10',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi!',
            'nama.min' => 'Nama minimal 3 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'no_hp.required' => 'No. Handphone wajib diisi!',
            'no_hp.regex' => 'Format nomor HP tidak valid! (08xxxxxxxxxx)',
            'alamat.required' => 'Alamat wajib diisi!',
            'alamat.min' => 'Alamat minimal 10 karakter!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Buat akun pelanggan baru
            $newId = $this->generateIdPelanggan();
            $pelanggan = Pelanggan::create([
                'id_pelanggan' =>  $validatedData['id_pelanggan'] = $newId;
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
                'auth_provider' => 'local',
                'provider_id' => null,
                'status' => 'inactive',
                'email_verified_at' => null,
            ]);

            // Generate token verifikasi
            $token = EmailVerification::generateToken($request->email);

            // Buat URL verifikasi
            $verificationUrl = url('/verify-email?token=' . $token);

            // Kirim email verifikasi
            try {
                Mail::to($request->email)->send(new VerificationEmail($request->nama, $verificationUrl));
                
                $emailSent = true;
                $message = 'Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi.';
            } catch (\Exception $e) {
                Log::error('Error sending verification email: ' . $e->getMessage());
                
                $emailSent = false;
                $message = 'Pendaftaran berhasil, namun email verifikasi gagal dikirim. Silakan hubungi admin.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'email_sent' => $emailSent,
                'redirect' => route('customer.login')
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Verify email
     */
    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect('/customer-login')->with('error', 'Token verifikasi tidak valid!');
        }

        // Validasi token
        $verification = EmailVerification::verifyToken($token);

        if (!$verification) {
            return redirect('/customer-login')->with('error', 'Token verifikasi tidak valid atau sudah kedaluwarsa!');
        }

        // Cari pelanggan
        $pelanggan = Pelanggan::where('email', $verification->email)->first();

        if (!$pelanggan) {
            return redirect('/customer-login')->with('error', 'Akun tidak ditemukan!');
        }

        // Cek apakah sudah terverifikasi
        if ($pelanggan->hasVerifiedEmail()) {
            EmailVerification::deleteToken($verification->email);
            return redirect('/customer-login')->with('info', 'Email Anda sudah terverifikasi sebelumnya. Silakan login.');
        }

        // Verifikasi email
        $pelanggan->markEmailAsVerified();

        // Hapus token
        EmailVerification::deleteToken($verification->email);

        // Redirect ke login dengan success message
        return redirect('/customer-login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    /**
     * Resend verification email
     */
    public function resendVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:tb_pelanggan,email',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.exists' => 'Email tidak terdaftar!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        // Cek apakah sudah terverifikasi
        if ($pelanggan->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => 'Email Anda sudah terverifikasi. Silakan login.'
            ], 400);
        }

        try {
            // Generate token baru
            $token = EmailVerification::generateToken($request->email);
            $verificationUrl = url('/verify-email?token=' . $token);

            // Kirim email
            Mail::to($request->email)->send(new VerificationEmail($pelanggan->nama, $verificationUrl));

            return response()->json([
                'success' => true,
                'message' => 'Email verifikasi telah dikirim ulang. Silakan cek inbox Anda.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error resending verification email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email verifikasi. Silakan coba lagi.'
            ], 500);
        }
    }
}
