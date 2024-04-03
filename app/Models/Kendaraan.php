<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopol', 'ujiemisi_id', 'user_id', 'merk', 'tipe', 'cc', 'tahun', 'tanggal_uji', 'no_rangka',  'no_mesin', 'bahan_bakar', 'kendaraan_kategori'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ujiemisis() {
        return $this->hasMany(UjiEmisi::class);
    }
}