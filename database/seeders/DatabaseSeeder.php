<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Bengkel;
use App\Models\UjiEmisi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        
        // Bengkel::create([
            //     'name' => 'Bengkel 2 AAA',
            //     'alamat' => 'Panyileukan',
            // ]);
            
            // Bengkel::create([
                //     'name' => 'Bengkel 1 BBB',
                //     'alamat' => 'Cipadung',
                // ]);


        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'bengkel_name' => 'Administrator',
            'kepala_bengkel' => 'Saka Media Satwika',
            'jalan' => 'Sauyunan',
            'kab_kota' => 'Bandung',
            'kecamatan' => 'Panyileukan',
            'kelurahan' => 'Cipadung Kidul',
            'is_admin' => true,
        ]);

        Kendaraan::factory(40)->create(); //

        UjiEmisi::factory(40)->create();
        // Kendaraan::create([
        //     'nopol' =>'C 1234 ZZZ',
        //     'merk' => 'Honda',
        //     'tipe' => 'Vario',
        //     'cc' => 150,
        //     'tahun' => 2020,
        // ]);

        // Kendaraan::create([
        //     'nopol' =>'F 5555 HUA',
        //     'merk' => 'Honda',
        //     'tipe' => 'Beat',
        //     'cc' => 110,
        //     'tahun' => 2012,
        // ]);

        // Kendaraan::create([
        //     'nopol' =>'Z 2222 ZUH',
        //     'merk' => 'Yamaha',
        //     'tipe' => 'NMAX',
        //     'cc' => 160,
        //     'tahun' => 2020,
        // ]);
    }
}
