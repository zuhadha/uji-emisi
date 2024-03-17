<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('uji-emisi.index'); 
        // sementara, dashboard diarahkan ke uji emisi seabagi halaman utama
    }
}
