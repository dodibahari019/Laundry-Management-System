<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user_login = Session::get('id_user');
        $username_login = Session::get('username');
        $role_login = Session::get('role');
        $nama_login = Session::get('nama');
        
        $pengeluaran = Pengeluaran::orderBy('tanggal_pengeluaran', 'desc')->paginate(10);
        $jumlahSemua = Pengeluaran::count();
        
        return view('pengeluaran.main', compact(
            'pengeluaran', 
            'jumlahSemua',
            'id_user_login', 
            'username_login', 
            'role_login', 
            'nama_login'
        ));
    }
    
    /**
     * Search/Filter pengeluaran (AJAX)
     */
    // public function search(Request $request)
    // {
    //     $nama = $request->get('nama', '');
    //     $kategori = $request->get('kategori', '');
    //     $tanggal_dari = $request->get('tanggal_dari', '');
    //     $tanggal_sampai = $request->get('tanggal_sampai', '');

    //     $pengeluaran = Pengeluaran::query();

    //     if ($nama) {
    //         $pengeluaran->where('nama_pengeluaran', 'like', "%{$nama}%");
    //     }

    //     if ($kategori) {
    //         $pengeluaran->where('kategori', $kategori);
    //     }

    //     if ($tanggal_dari) {
    //         $pengeluaran->whereDate('tanggal_pengeluaran', '>=', $tanggal_dari);
    //     }

    //     if ($tanggal_sampai) {
    //         $pengeluaran->whereDate('tanggal_pengeluaran', '<=', $tanggal_sampai);
    //     }

    //     $pengeluaran = $pengeluaran->orderBy('tanggal_pengeluaran', 'desc')->paginate(10);
    //     $jumlahSemua = $pengeluaran->total();

    //     return response()->json([
    //         'data' => $pengeluaran->items(),
    //         'current_page' => $pengeluaran->currentPage(),
    //         'last_page' => $pengeluaran->lastPage(),
    //         'per_page' => $pengeluaran->perPage(),
    //         'total' => $pengeluaran->total(),
    //         'jumlahSemua' => $jumlahSemua,
    //     ]);
    // }

    public function search(Request $request)
{
    $nama = $request->get('nama', '');
    $kategori = $request->get('kategori', '');
    $tanggal_dari = $request->get('tanggal_dari', '');
    $tanggal_sampai = $request->get('tanggal_sampai', '');

    $pengeluaran = Pengeluaran::query();

    if ($nama) {
        $pengeluaran->where('nama_pengeluaran', 'like', "%{$nama}%");
    }

    if ($kategori) {
        $pengeluaran->where('kategori', $kategori);
    }

    if ($tanggal_dari) {
        $pengeluaran->whereDate('tanggal_pengeluaran', '>=', $tanggal_dari);
    }

    if ($tanggal_sampai) {
        $pengeluaran->whereDate('tanggal_pengeluaran', '<=', $tanggal_sampai);
    }

    // TAMBAHKAN INI - Hitung total sebelum pagination
    $totalJumlah = $pengeluaran->sum('jumlah');

    $pengeluaran = $pengeluaran->orderBy('tanggal_pengeluaran', 'desc')->paginate(10);
    $jumlahSemua = $pengeluaran->total();

    return response()->json([
        'data' => $pengeluaran->items(),
        'current_page' => $pengeluaran->currentPage(),
        'last_page' => $pengeluaran->lastPage(),
        'per_page' => $pengeluaran->perPage(),
        'total' => $pengeluaran->total(),
        'jumlahSemua' => $jumlahSemua,
        'totalJumlah' => $totalJumlah, // TAMBAHKAN INI
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Convert format Rupiah ke angka
            $request->merge([
                'jumlah' => str_replace('.', '', $request->jumlah),
            ]);

            $validated = $request->validate([
                'nama_pengeluaran' => 'required|string|max:100',
                'tanggal_pengeluaran' => 'required|date',
                'kategori' => 'required|in:operasional,peralatan,bahan,gaji,utilitas,lainnya',
                'jumlah' => 'required|numeric|min:0',
            ]);

            Pengeluaran::create([
                'nama_pengeluaran' => $validated['nama_pengeluaran'],
                'tanggal_pengeluaran' => $validated['tanggal_pengeluaran'],
                'kategori' => $validated['kategori'],
                'jumlah' => $validated['jumlah'],
                'status' => 'aktif',
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataPengeluaranById = Pengeluaran::select([
            'id_pengeluaran',
            'nama_pengeluaran',
            'tanggal_pengeluaran',
            'kategori',
            'jumlah',
            'status',
        ])
        ->where('id_pengeluaran', $id)
        ->get();
        
        return view('pengeluaran.edit', compact('dataPengeluaranById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Convert format Rupiah ke angka
            $request->merge([
                'jumlah' => str_replace('.', '', $request->jumlah),
            ]);

            $validated = $request->validate([
                'nama_pengeluaran' => 'required|string|max:100',
                'tanggal_pengeluaran' => 'required|date',
                'kategori' => 'required|in:operasional,peralatan,bahan,gaji,utilitas,lainnya',
                'jumlah' => 'required|numeric|min:0',
            ]);

            $pengeluaran = Pengeluaran::where('id_pengeluaran', $id)->firstOrFail();

            $pengeluaran->update([
                'nama_pengeluaran' => $validated['nama_pengeluaran'],
                'tanggal_pengeluaran' => $validated['tanggal_pengeluaran'],
                'kategori' => $validated['kategori'],
                'jumlah' => $validated['jumlah'],
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->back();
    }
}