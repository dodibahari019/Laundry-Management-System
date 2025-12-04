<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataLayanan = Layanan::orderBy('nama_layanan')->paginate(10);
        $jumlahSemua = Layanan::count();
        $jumlahAktif = Layanan::where('status', 'Aktif')->count();
        $jumlahNonAktif = Layanan::where('status', 'Nonaktif')->count();
        return view('layanan.main', compact('dataLayanan', 'jumlahSemua', 'jumlahAktif', 'jumlahNonAktif'));
    }

    // public function search(Request $request)
    // {
    //     $query = $request->get('q', '');

    //     $dataLayanan = Layanan::where('nama_layanan', 'like', "%{$query}%")
    //         ->orderBy('nama_layanan')
    //         ->paginate(10);

    //     // Buat response JSON
    //     return response()->json([
    //         'data' => $dataLayanan->items(),       // array data untuk table
    //         'current_page' => $dataLayanan->currentPage(),
    //         'last_page' => $dataLayanan->lastPage(),
    //         'per_page' => $dataLayanan->perPage(),
    //         'total' => $dataLayanan->total(),
    //     ]);
    // }

    public function search(Request $request)
    {
        $layanan = $request->get('layanan', '');
        $jenis = $request->get('jenis', '');
        $harga = $request->get('harga', '');

        $dataLayanan = Layanan::query();

        if ($layanan) {
            $dataLayanan->where('nama_layanan', 'like', "%{$layanan}%");
        }

        if ($jenis) {
            $dataLayanan->where('jenis', $jenis);
        }

        if ($harga) {
            if ($harga == 'lt5000') {
                $dataLayanan->where('harga', '<', 5000);
            } elseif ($harga == '5000-10000') {
                $dataLayanan->whereBetween('harga', [5000, 10000]);
            } elseif ($harga == 'gt10000') {
                $dataLayanan->where('harga', '>', 10000);
            }
        }

        $dataLayanan = $dataLayanan->orderBy('nama_layanan')->paginate(10);
        // Hitung jumlah aktif/nonaktif
        $jumlahSemua = $dataLayanan->count();
        $jumlahAktif = $dataLayanan->where('status', 'Aktif')->count();
        $jumlahNonAktif = $dataLayanan->where('status', '!=', 'Aktif')->count();


        return response()->json([
            'data' => $dataLayanan->items(),
            'current_page' => $dataLayanan->currentPage(),
            'last_page' => $dataLayanan->lastPage(),
            'per_page' => $dataLayanan->perPage(),
            'total' => $dataLayanan->total(),
            'jumlahSemua' => $jumlahSemua,
            'jumlahAktif' => $jumlahAktif,
            'jumlahNonAktif' => $jumlahNonAktif,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try{
            $request->merge([
                'harga' => str_replace('.', '', $request->harga),
            ]);
            $validated = $request->validate([
                'nama_layanan' => 'required|string|max:50',
                'jenis' => 'required|string|max:20',
                'durasi' => 'required|int|min:1',
                'status' => 'required|in:Aktif,Nonaktif',
                'harga' => 'required|numeric|min:0',
            ]);

            // Cari ID terakhir
            $lastIdTransaksi = Layanan::orderBy('id_layanan', 'desc')->first();

            if ($lastIdTransaksi) {
                $lastNumber = (int)substr($lastIdTransaksi->id_layanan, 3); // Ambil angka dari 'SUP001'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'LYN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            Layanan::create([
                'id_layanan' => $newId,
                'nama_layanan' => $validated['nama_layanan'],
                'jenis' => $validated['jenis'],
                'harga' => $validated['harga'],
                'durasi' => $validated['durasi'],
                'status' => $validated['status'],
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_layanan)
    {
        $dataLayananById = Layanan::select([
            'tb_layanan.id_layanan',
            'tb_layanan.nama_layanan',
            'tb_layanan.jenis',
            'tb_layanan.harga',
            'tb_layanan.durasi',
            'tb_layanan.status',
        ])
        ->where('id_layanan', $id_layanan)
        ->get();
        return view('layanan.edit', compact('dataLayananById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_layanan)
    {
        // dd($request->all());
        try{
            $request->merge([
                'harga' => str_replace('.', '', $request->harga),
            ]);
            $validated = $request->validate([
                'nama_layanan' => 'required|string|max:50',
                'jenis' => 'required|string|max:20',
                'durasi' => 'required|int|min:1',
                'status' => 'required|in:Aktif,Nonaktif',
                'harga' => 'required|numeric|min:0',
            ]);

            Layanan::where('id_layanan', $id_layanan)->update([
                'nama_layanan' => $validated['nama_layanan'],
                'jenis' => $validated['jenis'],
                'harga' => $validated['harga'],
                'durasi' => $validated['durasi'],
                'status' => $validated['status'],
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
    public function destroy(string $id_layanan)
    {
        $dataLayanan = Layanan::findOrFail($id_layanan);
        $dataLayanan->delete();

        return redirect()->back();
    }
}
