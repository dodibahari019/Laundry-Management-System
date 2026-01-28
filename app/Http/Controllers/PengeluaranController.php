<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        // Ambil data user yang login
        $user = Auth::user();
        $nama_login = $user->nama_user ?? 'User';
        $username_login = $user->username ?? 'user';
        $role_login = $user->role ?? 'user';

        $pengeluaran = Pengeluaran::orderBy('tanggal_pengeluaran', 'desc')->get();

        return view('pengeluaran.main', compact('pengeluaran', 'nama_login', 'username_login', 'role_login'));
    }

    // Menampilkan form tambah (untuk modal)
    public function create()
    {
        return view('pengeluaran.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pengeluaran' => 'required|string|max:100',
            'tanggal_pengeluaran' => 'required|date',
            'kategori' => 'required|in:operasional,peralatan,bahan,gaji,utilitas,lainnya',
            'jumlah' => 'required|string',
        ]);

        // Convert jumlah dari format Rupiah ke angka
        $jumlah = str_replace('.', '', $validated['jumlah']);
        $validated['jumlah'] = (float) $jumlah;

        // Simpan ke database
        Pengeluaran::create($validated);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan!');
    }

    // Menampilkan form edit (untuk modal)
    public function edit($id)
    {
        $dataPengeluaranById = Pengeluaran::where('id_pengeluaran', $id)->get();
        return view('pengeluaran.edit', compact('dataPengeluaranById'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_pengeluaran' => 'required|string|max:100',
            'tanggal_pengeluaran' => 'required|date',
            'kategori' => 'required|in:operasional,peralatan,bahan,gaji,utilitas,lainnya',
            'jumlah' => 'required|string',
        ]);

        // Convert jumlah dari format Rupiah ke angka
        $jumlah = str_replace('.', '', $validated['jumlah']);
        $validated['jumlah'] = (float) $jumlah;

        // Update database
        $pengeluaran->update($validated);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus!');
    }

    // Ambil tabel (untuk AJAX)
    public function getTable()
    {
        $pengeluaran = Pengeluaran::orderBy('tanggal_pengeluaran', 'desc')->get();
        return view('pengeluaran.table', compact('pengeluaran'));
    }
}