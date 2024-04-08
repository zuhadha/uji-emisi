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
        if (auth()->user()->user_kategori != 'bengkel' || auth()->user()->is_admin) {
            $kendaraan = Kendaraan::count();
            $ujiEmisi = UjiEmisi::count();
            $avg = UjiEmisi::selectRaw('sum(co) as CO, sum(hc) as HC, sum(opasitas) as Opasitas')->first();
            $lastUjiEmisi = UjiEmisi::orderBy('id', 'desc')->take(10)->get();
        } else {
            $kendaraan = Kendaraan::where('user_id', auth()->id())->count();
            $ujiEmisi = UjiEmisi::where('user_id', auth()->id())->count();
            $avg = UjiEmisi::where('user_id', auth()->id())->selectRaw('sum(co) as CO, sum(hc) as HC, sum(opasitas) as Opasitas')->first();
            $lastUjiEmisi = UjiEmisi::where('user_id', auth()->id())->orderBy('id', 'desc')->take(10)->get();
        }
        $averages = [];
        $max = ['CO' => 10, 'HC' => 1200, 'Opasitas' => 70];
        foreach ($avg->toArray() as $l => $a) {
            $averages[] = [
                'label' => $l,
                'value' => $ujiEmisi == 0 ? 0 : number_format($a / $ujiEmisi, 2),
                'max' => $max[$l],
                'color' => 'primary'
            ];
        }
        return view('dashboard', compact('bengkel', 'kendaraan', 'ujiEmisi', 'averages', 'lastUjiEmisi'));
    }
}
