<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DashboardKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        $keyword=$request->keyword;

        if (auth()->user()->is_admin) {
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
            // If the logged-in user is not an admin, filter the rows based on the user's bengkel_id
            $kendaraans = Kendaraan::where('nopol', 'LIKE', '%'.$keyword.'%')
                ->orWhere('tahun','LIKE', '%'.$keyword.'%')
                ->orWhere('merk','LIKE', '%'.$keyword.'%')
                ->orWhere('tipe','LIKE', '%'.$keyword.'%')
                ->orWhere('bahan_bakar','LIKE', '%'.$keyword.'%')    
                ->whereHas('user', function ($query) {
                    $query->where('id', auth()->user()->id);
                })
                ->paginate(11);
            // $kendaraans = Kendaraan::whereHas('user', function ($query) {
            //     $query->where('id', auth()->user()->id);
            // })->paginate(10);
        }

        return view('dashboard.kendaraan.index', [
            "title" => "List Kendaraan",
            "kendaraans" => $kendaraans, 
            "bengkel" => auth()->user()->bengkel_name,
            "keyword" => $keyword
        ]);
    }


    /**
     * Show the form for creating a new resource.
    //  * @param \Illuminate\Http\Request
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kendaraan.form-kendaraan', [
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
    //  * @param \App\Models\Kendaraan
    //  * @return \Illuminate\Http\Response
     */

    public function show(Kendaraan $kendaraan)
    {
        return view('dashboard.kendaraan.show', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan)
    {

        // dd($kendaraan);
        return view('/dashboard/kendaraan/edit-kendaraan', [
            'kendaraan' => $kendaraan,
            "bengkel_name" => auth()->user()->bengkel_name,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validatedData = $request->validate([
            'nopol' => 'required', 
            'merk' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|gt:1900',
            'cc' => 'required|gt:100',
            'no_rangka' => '',
            'no_mesin' => '',
            'bahan_bakar' => '',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        
        Kendaraan::where('id', $kendaraan->id)->update($validatedData);
        // Simpan kendaraan_id dalam session
        session()->put('idKendaraan', $kendaraan->id);

        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        Kendaraan::destroy($kendaraan->id);

        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil dihapus');
    }
}
