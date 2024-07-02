<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\UjiEmisi;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'bengkel' => User::where(['user_kategori' => 'bengkel', 'is_admin' => 0])->count(),
            'kendaraan' => Kendaraan::count(),
            'uji_emisi' => UjiEmisi::count()
        ]);
    }
}
