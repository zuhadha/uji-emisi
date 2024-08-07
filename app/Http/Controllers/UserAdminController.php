<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $keyword = $request->keyword;

        // $users = User::all()
        //     ->select('users.*')
        //     ->paginate(10);
        // $users->appends($request->all());

        $users = User::paginate(10)->appends($request->all());

        
        $totalRecords = $users->total();

        return view('dashboard.User.index', [
            "title" => "Manajemen Pengguna",
            "users" => $users,
            "totalRecords" => $totalRecords,
            "bengkel_name" => auth()->user()->bengkel_name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.User.form-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isNotFilled('perusahaan_name')) $request->merge(['perusahaan_name' => '-']);
        $validatedData = $request->validate([
            'bengkel_name' => 'required',
            'perusahaan_name' => '',
            'username' => 'required',
            'kepala_bengkel' => 'required',
            'password' => 'required',
            'user_kategori' => '',
            'jalan' => '',
            'kab_kota' => '',
            'kecamatan' => '',
            'kelurahan' => '',
            'alat_uji' => '',
            'tanggal_kalibrasi_alat' => '',
        ]);

        User::create($validatedData);

        return redirect('/dashboard/user')->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.User.edit-user', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // asli
    // public function update(Request $request, User $user)
    // {
    //     $validatedData = $request->validate([
    //         'bengkel_name' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',
    //         'jalan' => '',
    //         'kab_kota' => '',
    //         'kecamatan' => '',
    //         'kelurahan' => '',
    //     ]);

    //     $validatedData['user_id'] = auth()->user()->id;


    //     User::where('id', $user->id)->update($validatedData);

    //     return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil diedit');
    // }

    //percobaan
    public function update(Request $request, User $user)
    {
        if ($request->isNotFilled('perusahaan_name')) $request->merge(['perusahaan_name' => '-']);
        $validatedData = $request->validate([
            'bengkel_name' => 'required',
            'perusahaan_name' => 'required',
            'username' => 'required',
            'kepala_bengkel' => 'required',
            'password' => 'required',
            'user_kategori' => '',
            'jalan' => '',
            'kab_kota' => '',
            'kecamatan' => '',
            'kelurahan' => '',
            'alat_uji' => '',
            'tanggal_kalibrasi_alat' => '',
        ]);

        // Menambahkan user_id
        $validatedData['user_id'] = auth()->user()->id;

        // Melakukan update data user
        $user->update($validatedData);

        return redirect('/dashboard/user')->with('success', 'User berhasil diedit');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/dashboard/user')->with('success', 'User berhasil dihapus');
    }
}
