<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    private function generateIdPelanggan()
    {
        $last = Pelanggan::orderBy('id_pelanggan', 'DESC')->first();

        if (!$last) {
            return 'PLG001';
        }

        $num = intval(substr($last->id_pelanggan, 3)) + 1;

        $newId = 'PLG' . str_pad($num, 3, '0', STR_PAD_LEFT);
        while (Pelanggan::where('id_pelanggan', $newId)->exists()) {
            $num++;
            $newId = 'PLG' . str_pad($num, 3, '0', STR_PAD_LEFT);
        }
        return $newId;
    }

    // TAMPILKAN DATA (halaman utama)
    public function index(Request $request)
    {

        $dataPelanggan  = Pelanggan::orderBy('nama')->paginate(10);
        $jumlahSemua = Pelanggan::count();
        return view('pelanggan.main', compact(
            'dataPelanggan',
            'jumlahSemua'
        ));
    }

    // SEARCH UNTUK AJAX
    public function search(Request $request)
    {
        $searchInput = $request->get('searchInput', '');
        $otherFilter = $request->get('otherFilter', '');

        $query = Pelanggan::query();

        // SEARCH: Cari di nama, no_hp, email, alamat
        if ($searchInput) {
            $query->where(function ($q) use ($searchInput) {
                $q->where('nama', 'like', "%{$searchInput}%")
                    ->orWhere('no_hp', 'like', "%{$searchInput}%")
                    ->orWhere('email', 'like', "%{$searchInput}%")
                    ->orWhere('alamat', 'like', "%{$searchInput}%");
            });
        }

        // SORTING
        switch ($otherFilter) {
            case 'nama_asc':
                $query->orderBy('nama', 'ASC');
                break;
            case 'nama_desc':
                $query->orderBy('nama', 'DESC');
                break;
            case 'terbaru':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'lama':
                $query->orderBy('created_at', 'ASC');
                break;
            default:
                $query->orderBy('id_pelanggan', 'DESC');
        }

        $dataPelanggan = $query->paginate(10);  // Paginate 10 seperti index()

        // Return JSON
        return response()->json([
            'data' => $dataPelanggan->items(),
            'current_page' => $dataPelanggan->currentPage(),
            'last_page' => $dataPelanggan->lastPage(),
            'per_page' => $dataPelanggan->perPage(),
            'total' => $dataPelanggan->total(),
        ]);
    }

    // FORM TAMBAH
    public function create()
    {
        return view('pelanggan.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        try {
            // generate ID
            $newId = $this->generateIdPelanggan();
            // Debug: Log ID yang di-generate
            \Log::info('Generated ID: ' . $newId);
            $validatedData = $request->validate([
                'nama'   => 'required|string|max:100',
                'no_hp'  => 'required|string|max:20',
                'email'  => 'required|email|unique:tb_pelanggan,email',
                'alamat' => 'required|string',
            ]);

            // Inject id baru
            $validatedData['id_pelanggan'] = $newId;
            Pelanggan::create($validatedData);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    // FORM EDIT
    public function edit(string $id_pelanggan)
    {
        $dataPelangganById = Pelanggan::select([
            'tb_pelan'
            'tb_pelanggan.nama',
            'tb_pelanggan.no_hp',
            'tb_pelanggan.email',
            'tb_pelanggan.alamat',
        ])
            ->where('id_pelanggan', $id_pelanggan)
            ->get();

        return view('pelanggan.edit', compact('dataPelangganById'));
    }

    // SIMPAN PERUBAHAN
    public function update(Request $request, string $id_pelanggan)
    {
        try {
            $validated = $request->validate([
                'nama'   => 'required|string|max:100',
                'no_hp'  => 'required|string|max:20',
                'email'  => 'required|string|max:100',
                'alamat' => 'required|string',
            ]);

            Pelanggan::where('id_pelanggan', $id_pelanggan)->update([
                'nama'   => $validated['nama'],
                'no_hp'  => $validated['no_hp'],
                'email'  => $validated['email'],
                'alamat' => $validated['alamat'],
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ]);
        }
    }

    // HAPUS DATA
    public function destroy($id_pelanggan)
    {
        Pelanggan::where('id_pelanggan', $id_pelanggan)->delete();

        return redirect('/pelanggan')->with('success', 'Data berhasil dihapus!');
    }
}