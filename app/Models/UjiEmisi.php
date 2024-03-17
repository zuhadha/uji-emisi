<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UjiEmisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'odometer', 'kendaraan_id', 'user_id', 'co', 'hc', 'opasitas', 'co2', 'co_koreksi', 'o2', 'putaran', 'tanggal_uji', 'temperatur', 'lambda', 'certificate'
    ];

    // menginput tanggal uji secara otomatis dengan tanggal saat ini.
    protected static function booted()
    {
        static::creating(function ($ujiEmisi) {
            $ujiEmisi->tanggal_uji = Carbon::now();
        });
    }

    public function kendaraan() {
        return $this->belongsTo(Kendaraan::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
