<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'bengkel_name',
        'perusahaan_name',
        'kepala_bengkel',
        'jalan',
        'kab_kota',
        'kecamatan',
        'kelurahan',
        'is_admin',
        'user_kategori',
        'alat_uji',
        'tanggal_kalibrasi_alat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];


    protected $attributes = [
        'is_admin' => false,
        'user_kategori' => 'bengkel',
        'perusahaan_name' => '-'
    ];

    // public function bengkel() {
    //     return $this->belongsTo(Bengkel::class);
    // }

    public function kendaraans() {
        return $this->hasMany(Kendaraan::class);
    }

    public function ujiemisis() {
        return $this->hasMany(UjiEmisi::class);
    }
}
