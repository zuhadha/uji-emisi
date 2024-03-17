<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index() {

        return view('/dashboard/kendaraan/list-kendaraan', [
            "title" => "List Kendaraan",
            "kendaraans" => Kendaraan::whereHas('user', function ($query) {
                $query->where('bengkel_id', auth()->user()->bengkel_id);
            })->get()
    
        ]);
    }

    public function show($id) {
        return view('/dashboard/kendaraan/form-kendaraan', [
            'title' => 'kendaraan anda',
            'kendaraan' => Kendaraan::find($id)
        ]);
    }
}
