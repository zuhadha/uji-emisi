<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\UjiEmisi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $bengkel = User::count();
        $kendaraan = Kendaraan::count();
        $ujiEmisi = UjiEmisi::count();
        $avg = UjiEmisi::selectRaw('sum(co) as CO, sum(hc) as HC, sum(opasitas) as Opasitas')->first();
        $averages = [];
        $max = ['CO' => 10, 'HC' => 1200, 'Opasitas' => 70];
        foreach ($avg->toArray() as $l => $a) {
            $averages[] = [
                'label' => $l,
                'value' => number_format($a / $ujiEmisi, 2),
                'max' => $max[$l],
                'color' => 'primary'
            ];
        }
        $lastUjiEmisi = UjiEmisi::orderBy('id', 'desc')->take(10)->get();
        return view('dashboard', compact('bengkel', 'kendaraan', 'ujiEmisi', 'averages', 'lastUjiEmisi'));
    }
}
