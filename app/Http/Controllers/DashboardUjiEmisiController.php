<?php

namespace App\Http\Controllers;

use App\Models\UjiEmisi;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class DashboardUjiEmisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            // If the logged-in user is an admin, query all rows
            $kendaraans = Kendaraan::all();
        } else {
            // If the logged-in user is not an admin, filter the rows based on the user's bengkel_id
            $kendaraans = Kendaraan::whereHas('user', function ($query) {
                $query->where('bengkel_id', auth()->user()->bengkel_id);
            })->get();
        }

        return view('/dashboard/ujiemisi/index', [
            "title" => "List Kendaraan",
            "kendaraans" => $kendaraans
        ]);
    }

    /**
     * Show the form for creating a new resource.
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/dashboard/ujiemisi/insert-uji');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UjiEmisi $ujiEmisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UjiEmisi $ujiEmisi)
    {
        return view('/dashboard/ujiemisi/edit-uji', [
            'ujiemisi' => $ujiEmisi,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UjiEmisi $ujiEmisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UjiEmisi $ujiEmisi)
    {
        //
    }
}
