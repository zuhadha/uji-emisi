<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUjiEmisiRequest;
use App\Http\Requests\UpdateUjiEmisiRequest;
use Illuminate\Http\Request;
use App\Models\UjiEmisi;
use App\Models\Kendaraan;

class UjiEmisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if (auth()->user()->is_admin) {
            
            $keyword=$request->keyword;
            // If the logged-in user is an admin, query all rows
            $kendaraans = Kendaraan::with('ujiemisis')->get();
            $ujiemisis = UjiEmisi::with('kendaraan')
            ->where('tanggal_uji', 'LIKE', '%'.$keyword.'%')
            // ->orWhere('tahun','LIKE', '%'.$keyword.'%')
            // ->orWhere('merk','LIKE', '%'.$keyword.'%')
            // ->orWhere('tipe','LIKE', '%'.$keyword.'%')
            // ->orWhere('bahan_bakar','LIKE', '%'.$keyword.'%')
            ->paginate(11);
        } else {
            // If the logged-in user is not an admin, filter the rows based on the user's id
            $kendaraans = Kendaraan::where('user_id', auth()->user()->id)->with('ujiemisis')->get();

            $ujiemisis = UjiEmisi::whereHas('user', function ($query) {
                $query->where('id', auth()->user()->id);
            })->with('kendaraan')->get();
        }

        return view('/dashboard/ujiemisi/index', [
            "title" => "List Kendaraan",
            "kendaraans" => $kendaraans, // Gunakan kendaraans di view jika diperlukan
            "ujiemisis" => $ujiemisis,
            "bengkel_name" => auth()->user()->bengkel_name,
            "keyword" => $keyword
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('dashboard/ujiemisi/insert-uji', [
            "bengkel_name" => auth()->user()->bengkel_name,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreUjiEmisiRequest $request)
    {
        $validatedData = $request->validate([
            'odometer' => 'required', 
            'co' => 'required',
            'hc' => 'required',
            'opasitas' => '',
            'co2' => '',
            'co_koreksi' => '',
            'o2' => '',
            'putaran' => '',
            'temperatur' => '',
            'lambda' => '',
        ]);

        
        // $idKendaraanBaru = session()->get('idKendaraanBaru'); //ini gak perlu
        
        $lastKendaraan = Kendaraan::orderBy('id', 'desc')->first();
        $lastKendaraanId = $lastKendaraan ? $lastKendaraan->id : 0;

        $idKendaraanBaru = $lastKendaraanId;

        if ($idKendaraanBaru) {
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['kendaraan_id'] = $idKendaraanBaru;
            


            UjiEmisi::create($validatedData);
            // Hapus kendaraan_id dari session setelah digunakan
            // session()->forget('idKendaraanBaru'); // ini gak perlu
            return redirect('/dashboard/ujiemisi')->with('success', 'Hasil Uji berhasil ditambah');
        } else {
            // Jika kendaraan_id tidak ada dalam session
            return redirect('/dashboard/ujiemisi')->with('error', 'Gagal menambahkan hasil uji. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUjiEmisiRequest $request, UjiEmisi $ujiEmisi)
    {

        $validatedData = $request->validate([
            'odometer' => 'required', 
            'co' => 'required',
            'hc' => 'required',
            'opasitas' => '',
            'co2' => '',
            'co_koreksi' => '',
            'o2' => '',
            'putaran' => '',
            'temperatur' => '',
            'lambda' => '',
        ]);

        $idKendaraan = session()->get('idKendaraan');

        if ($idKendaraan) {
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['kendaraan_id'] = $idKendaraan;
            
            UjiEmisi::where('id', $ujiEmisi->id)->update($validatedData);

            // Hapus kendaraan_id dari session setelah digunakan
            session()->forget('idKendaraanBaru');
    
            return redirect('/dashboard/ujiemisi')->with('success', 'Hasil Uji berhasil diedit');
        } else {
            // Jika kendaraan_id tidak ada dalam session
            return redirect('/dashboard/ujiemisi')->with('error', 'Gagal menambahkan hasil uji. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UjiEmisi $ujiEmisi)
    {
        //
    }
}
