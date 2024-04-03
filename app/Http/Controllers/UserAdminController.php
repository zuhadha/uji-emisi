<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('dashboard.User.index', [
            "title" => "Manajemen Pengguna",
            "users" => $users,
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
        $validatedData = $request->validate([
            'bengkel_name' => 'required',
            'username' => 'required',
            'kepala_bengkel' => 'required',
            'password' => 'required',
            'jalan' => '',
            'kab_kota' => '',
            'kecamatan' => '',
            'kelurahan' => '',
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
    $validatedData = $request->validate([
        'bengkel_name' => 'required',
        'username' => 'required',
        'kepala_bengkel' => 'required',
        'password' => '',
        'jalan' => '',
        'kab_kota' => '',
        'kecamatan' => '',
        'kelurahan' => '',
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
