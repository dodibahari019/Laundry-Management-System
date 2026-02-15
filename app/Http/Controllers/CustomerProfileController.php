<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class CustomerProfileController extends Controller
{
    /**
     * Display customer profile page
     */
    public function index()
    {
        // Check if customer is logged in
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('customer.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $customer = Auth::guard('pelanggan')->user();
        $top4Layanan = Layanan::join('tb_order_items', 'tb_layanan.id_layanan', '=', 'tb_order_items.id_layanan')
            ->join('tb_orders', 'tb_order_items.id_order', '=', 'tb_orders.id_order')
            ->join('tb_pembayaran', 'tb_orders.id_order', '=', 'tb_pembayaran.id_order')
            ->select(
                'tb_layanan.id_layanan',
                'tb_layanan.nama_layanan',
                'tb_layanan.jenis',
                'tb_layanan.harga',
                'tb_layanan.foto',
                DB::raw('COUNT(tb_order_items.id_order) as jumlah_transaksi')
            )
            ->where('tb_layanan.status', 'Aktif')
            // ->where('tb_pembayaran.status', 'settlement')
            ->groupBy('tb_layanan.id_layanan', 'tb_layanan.nama_layanan', 'tb_layanan.jenis', 'tb_layanan.harga', 'tb_layanan.foto')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->take(5)
            ->get();


        return view('customerProfile', compact('customer', 'top4Layanan'));
    }

    /**
     * Update customer profile information
     */
    public function updateProfile(Request $request)
    {
        try {
            $customer = Auth::guard('pelanggan')->user();

            // Validation
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:tb_pelanggan,email,' . $customer->id_pelanggan . ',id_pelanggan',
                'no_hp' => 'required|string|max:20',
                'gender' => 'required|in:L,P',
                'kategori_alamat' => 'nullable|in:rumah,kost,kantor,hotel',
                'alamat' => 'required|string',
            ], [
                'first_name.required' => 'Nama depan harus diisi',
                'last_name.required' => 'Nama belakang harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'no_hp.required' => 'No. telepon harus diisi',
                'gender.required' => 'Jenis kelamin harus dipilih',
                'alamat.required' => 'Alamat harus diisi',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // Update customer data
            $customer->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'nama' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'gender' => $request->gender,
                'kategori_alamat' => $request->kategori_alamat,
                'alamat' => $request->alamat,
                'default_address' => $request->alamat,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update customer password (without verification)
     */
    public function updatePassword(Request $request)
    {
        try {
            $customer = Auth::guard('pelanggan')->user();

            // Validation
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ], [
                'current_password.required' => 'Password saat ini harus diisi',
                'new_password.required' => 'Password baru harus diisi',
                'new_password.min' => 'Password baru minimal 8 karakter',
                'new_password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // Check current password
            if (!Hash::check($request->current_password, $customer->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password saat ini tidak sesuai'
                ], 422);
            }

            // Check if new password is same as current password
            if (Hash::check($request->new_password, $customer->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password baru tidak boleh sama dengan password saat ini'
                ], 422);
            }

            // Update password (without verification)
            $customer->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diubah'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}