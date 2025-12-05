<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Users;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUsers = Users::orderBy('nama')->paginate(10);
        $jumlahSemua = Users::count();
        $jumlahAdmin = Users::where('role', 'admin')->count();
        $jumlahKasir = Users::where('role', 'kasir')->count();
        $jumlahPetugas = Users::where('role', 'petugas')->count();
        return view('users.main', compact('dataUsers', 'jumlahSemua', 'jumlahAdmin', 'jumlahKasir', 'jumlahPetugas'));
    }

     public function search(Request $request)
    {
        $users = $request->get('users', '');
        $role = $request->get('role', '');

        $dataUsers = Users::query();

        if ($users) {
            $dataUsers->where(function($q) use ($users) {
                $q->where('username', 'LIKE', "%{$users}%")
                ->orWhere('nama', 'LIKE', "%{$users}%")
                ->orWhere('email', 'LIKE', "%{$users}%")
                ;
            });
        }

        if ($role) {
            $dataUsers->where('role', $role);
        }

        $dataUsers = $dataUsers->orderBy('nama')->paginate(10);

        return response()->json([
            'data' => $dataUsers->items(),
            'current_page' => $dataUsers->currentPage(),
            'last_page' => $dataUsers->lastPage(),
            'per_page' => $dataUsers->perPage(),
            'total' => $dataUsers->total(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'username' => 'required|string|max:50',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'password' => 'required|string',
                'role' => 'required|in:admin,kasir,petugas',
            ]);

            // Cari ID terakhir
            $lastIdTransaksi = Users::orderBy('id_user', 'desc')->first();

            if ($lastIdTransaksi) {
                $lastNumber = (int)substr($lastIdTransaksi->id_user, 3); // Ambil angka dari 'SUP001'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $newId = 'USR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            Users::create([
                'id_user' => $newId,
                'username' => $validated['username'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role' => $validated['role'],
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
    public function edit(string $id_user)
    {
        $dataUsersById = Users::select([
            'tb_users.id_user',
            'tb_users.username',
            'tb_users.nama',
            'tb_users.email',
            'tb_users.password',
            'tb_users.role',
        ])
        ->where('id_user', $id_user)
        ->get();
        return view('users.edit', compact('dataUsersById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_user)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:50',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'password' => 'nullable|string', // password opsional
                'role' => 'required|in:admin,kasir,petugas',
            ]);

            $updateData = [
                'username' => $validated['username'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ];

            if (!empty($validated['password'])) {
                $updateData['password'] = bcrypt($validated['password']);
            }

            Users::where('id_user', $id_user)->update($updateData);
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
    public function destroy(string $id_user)
    {
        $dataUsers = Users::findOrFail($id_user);
        $dataUsers->delete();

        return redirect()->back();
    }
}
