<?php

namespace Database\Seeders;

use App\Models\AlatUji;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AlatUjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = ['CRO42','QROTECH','Technotest 488','Star Gas','sukyoung','OPA -820','Brain Bee'];

        $model = ['CRO','-','-','-','-','-','-'];

        $serialNumber = ['0','-','-','-','-','-','-'];

        $bengkelCabang = ['01/08/2014','-','-','-','-','-','-'];

        $bengkelAlamat = ['Jl. Soekarno Hatta 438 D Kav 1','Jl. Asia Afrika No 127','Jl. Raya Cibeureum No 42','Jl. Soekarno Hatta 438 D Kav 1','Jl. Asia Afrika No 125','Jl. Soekarno Hatta 759','Jl. Dr Djunjunan 192','Jl. Setiabudi 68','Jl. Soekarno Hatta 145','Jl. PHH Mustafa No 6','Jl. Soekarno Hatta 727','Jl. Ahmad Yani 352','Jl. Soekarno Hatta 517','Jl. Cicendo No 18','Jl. Raya Cimindi No.88','Jl. Dr Junjunan 168 B','Jl. Soekarno Hatta No.368','Jl. Cihampelas No 6','Jl. Soekarno Hatta 625','Jl. Soekarno Hatta No.471','Jl. Trs. Jalan Jakarta 32','Jl. Khatulistiwa No. 6 B','Jl. Buah Batu No.302','Jl. Jend. Gatot Subroto 176-178','Jl. Soekarno Hatta 382','Jl Veteran 51 - 55','Jl. Jend A. Yani 259','Jl. Soekarno Hatta 513','Jl. Soekarno Hatta 289','Jl. Soekarno Hatta 700','Jl. Peta 261','Jl. Batunggal Indah IX No.11','Jl. Pelajar Pejuang 45 No 103','Jl. RE Martadinata 122','Jl. Burangrang No 33','Jl. Soekarno Hatta No 342','Jl. WR.Supratman No 40','Jl. Soekarno Hatta 319','Jl. Peta - Lingkar selatan No 71','Jl. Vandeventer No 3','Jl. A Yani 281','Jl. Abdurahman Saleh No 4','Jl. Jendral Sudirman No 5','Jl. Soekarno Hatta No. 725 A','Jl. Soekarno Hatta No 725 B','Jl. Jend Ahmad Yani 229','Jl. Gatot Subroto 109 - 111','Jl. Raya Cilember 276','Jl. Terusan Kiara Condong 47','Jl. Cihampelas 203','Jl Jend A Yani 225 -227','Jl. Ir. H. Juanda No 131','Jl. Jend. Ahmad Yani No 336','Jl. BKR No.27','Jl. Soekarno Hatta No. 729A','Jl. Asia Afrika No.154','Jl. Pelajar Pejuang 45 No 47','Jl. Pelajar Pejuang 45 No 47','Jl. Dr. Setiabudhi No.65','Jl. Soekarno Hatta No. 291','Jl. Soekarno Hatta No. 291','Jl. Dr. Setiabudi No.176'];
        
        $bengkelAlamat = ['Jl. Soekarno Hatta 438 D Kav 1','Jl. Asia Afrika No 127','Jl. Raya Cibeureum No 42','Jl. Soekarno Hatta 438 D Kav 1','Jl. Asia Afrika No 125','Jl. Soekarno Hatta 759','Jl. Dr Djunjunan 192','Jl. Setiabudi 68','Jl. Soekarno Hatta 145','Jl. PHH Mustafa No 6','Jl. Soekarno Hatta 727','Jl. Ahmad Yani 352','Jl. Soekarno Hatta 517','Jl. Cicendo No 18','Jl. Raya Cimindi No.88','Jl. Dr Junjunan 168 B','Jl. Soekarno Hatta No.368','Jl. Cihampelas No 6','Jl. Soekarno Hatta 625','Jl. Soekarno Hatta No.471','Jl. Trs. Jalan Jakarta 32','Jl. Khatulistiwa No. 6 B','Jl. Buah Batu No.302','Jl. Jend. Gatot Subroto 176-178','Jl. Soekarno Hatta 382','Jl Veteran 51 - 55','Jl. Jend A. Yani 259','Jl. Soekarno Hatta 513','Jl. Soekarno Hatta 289','Jl. Soekarno Hatta 700','Jl. Peta 261','Jl. Batunggal Indah IX No.11','Jl. Pelajar Pejuang 45 No 103','Jl. RE Martadinata 122','Jl. Burangrang No 33','Jl. Soekarno Hatta No 342','Jl. WR.Supratman No 40','Jl. Soekarno Hatta 319','Jl. Peta - Lingkar selatan No 71','Jl. Vandeventer No 3','Jl. A Yani 281','Jl. Abdurahman Saleh No 4','Jl. Jendral Sudirman No 5','Jl. Soekarno Hatta No. 725 A','Jl. Soekarno Hatta No 725 B','Jl. Jend Ahmad Yani 229','Jl. Gatot Subroto 109 - 111','Jl. Raya Cilember 276','Jl. Terusan Kiara Condong 47','Jl. Cihampelas 203','Jl Jend A Yani 225 -227','Jl. Ir. H. Juanda No 131','Jl. Jend. Ahmad Yani No 336','Jl. BKR No.27','Jl. Soekarno Hatta No. 729A','Jl. Asia Afrika No.154','Jl. Pelajar Pejuang 45 No 47','Jl. Pelajar Pejuang 45 No 47','Jl. Dr. Setiabudhi No.65','Jl. Soekarno Hatta No. 291','Jl. Soekarno Hatta No. 291','Jl. Dr. Setiabudi No.176'];
        
        $usernameCount = count($brand);
        $bengkelCount = count($model);
        $passwordCount = count($serialNumber);
        $cabangCount = count($bengkelCabang);
        $alamatCount = count($bengkelAlamat);

        $totalCount = max($bengkelCount, $usernameCount, $passwordCount, $alamatCount);


        for ($index = 0; $index < $totalCount; $index++) {
            AlatUji::create([
                'brand' => $brand[$index % $usernameCount],
                'model' => $model[$index % $bengkelCount],
                'serial_number' => $serialNumber[$index % $passwordCount], // You may change this if needed
                'operate_time' => $bengkelCabang[$index % $cabangCount], // ini diisi cabang buat display di kiri
                'calibration_time' => '-',
                'supplier' => $bengkelAlamat[$index % $alamatCount], // alamat masuk sini semua aja
            ]);
        }
    }
}
