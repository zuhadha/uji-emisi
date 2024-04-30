<?php

namespace App\Http\Controllers;

use App\Models\AlatUji;
use App\Http\Requests\StoreAlatUjiRequest;
use App\Http\Requests\UpdateAlatUjiRequest;
use Illuminate\Http\Request;


class AlatUjiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $alatUjis = AlatUji::paginate(10)->appends($request->all());

        
        $totalRecords = $alatUjis->total();

        return view('dashboard.AlatUji.index', [
            "title" => "Manajemen Alat Uji",
            "alatUjis" => $alatUjis,
            "totalRecords" => $totalRecords,
            "bengkel_name" => auth()->user()->bengkel_name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.AlatUji.form-alat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlatUjiRequest $request)
    {
        if ($request->isNotFilled('perusahaan_name')) $request->merge(['perusahaan_name' => '-']);
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'nullable',
            'serial_number' => 'nullable',
            'operate_time' => 'nullable',
            'calibration_time' => 'nullable',
            'supplier' => 'nullable',
        ]);

        AlatUji::create($validatedData);

        return redirect('/dashboard/alatuji')->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(AlatUji $alatUji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlatUji $alatUji)
    {
        return view('dashboard.AlatUji.edit-alat', [
            'alatUji' => $alatUji,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlatUjiRequest $request, AlatUji $alatUji)
    {
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'nullable',
            'serial_number' => 'nullable',
            'operate_time' => 'nullable',
            'calibration_time' => 'nullable',
            'supplier' => 'nullable',
        ]);

        // Melakukan update data alat uji
        $alatUji->update($validatedData);

        return redirect('/dashboard/alatuji')->with('success', 'Alat uji berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlatUji $alatUji)
    {
        AlatUji::destroy($alatUji->id);

        return redirect('/dashboard/alatuji')->with('success', 'Alat uji berhasil dihapus');
    }
}
