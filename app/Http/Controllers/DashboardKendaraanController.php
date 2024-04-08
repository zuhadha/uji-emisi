<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\UjiEmisi;
use Illuminate\Http\Request;

class DashboardKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UjiEmisi $ujiemisi) {

        $keyword=$request->keyword;

        if (auth()->user()->is_admin || auth()->user()->user_kategori != 'bengkel') {
            // If the logged-in user is an admin, query all rows
            // $kendaraans = Kendaraan::all();
            $kendaraans = Kendaraan::where('nopol', 'LIKE', '%'.$keyword.'%')
                ->orWhere('tahun','LIKE', '%'.$keyword.'%')
                ->orWhere('merk','LIKE', '%'.$keyword.'%')
                ->orWhere('tipe','LIKE', '%'.$keyword.'%')
                ->orWhere('bahan_bakar','LIKE', '%'.$keyword.'%')
                ->paginate(11);
            $kendaraans->appends($request->all());
        } else {
            // If the logged-in user is not an admin, filter the rows based on the user's id
            $kendaraans = Kendaraan::where('user_id', auth()->user()->id)
            ->where(function($query) use ($keyword) {
                $query->where('nopol', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('tahun','LIKE', '%'.$keyword.'%')
                    ->orWhere('merk','LIKE', '%'.$keyword.'%')
                    ->orWhere('tipe','LIKE', '%'.$keyword.'%')
                    ->orWhere('bahan_bakar','LIKE', '%'.$keyword.'%');
            })
            ->paginate(11);
            $kendaraans->appends($request->all());

        }


        $totalRecords = $kendaraans->total();

        return view('dashboard.Kendaraan.index', [
            "title" => "List Kendaraan",
            "kendaraans" => $kendaraans,
            "bengkel" => auth()->user()->bengkel_name,
            "keyword" => $keyword,
            "ujiemisi" => $ujiemisi,
            "totalRecords" => $totalRecords
        ]);
    }


    /**
     * Show the form for creating a new resource.
      * @param \Illuminate\Http\Request
      * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Kendaraan.form-kendaraan', [
            "bengkel_name" => auth()->user()->bengkel_name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     // original
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nopol' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|gt:1900',
            'cc' => 'required|gt:100',
            'no_rangka' => '',
            'no_mesin' => '',
            'kendaraan_kategori' => '',
            'bahan_bakar' => '',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $kendaraan = Kendaraan::create($validatedData);

        // Simpan kendaraan_id dalam session
        // session()->put('idKendaraanBaru', $kendaraan->id);

        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
      * @param \App\Models\Kendaraan
      * @return \Illuminate\Http\Response
     */

    public function show(Kendaraan $kendaraan)
    {
        return view('dashboard.Kendaraan.show', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan)
    {
        // dd($kendaraan);
        return view('dashboard.Kendaraan.edit-kendaraan', [
            'kendaraan' => $kendaraan,
            "bengkel_name" => auth()->user()->bengkel_name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {

        // dd($request);

        $validatedData = $request->validate([
            'nopol' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|gt:1900',
            'cc' => 'required|gt:100',
            'no_rangka' => '',
            'no_mesin' => '',
            'kendaraan_kategori' => '',
            'bahan_bakar' => '',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Kendaraan::where('id', $kendaraan->id)->update($validatedData);

        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {

        // hapus semua hasil uji emisi dari kendaraan tersebut
        UjiEmisi::where('kendaraan_id', $kendaraan->id)->delete();

        Kendaraan::destroy($kendaraan->id);
        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil dihapus');
    }
}
