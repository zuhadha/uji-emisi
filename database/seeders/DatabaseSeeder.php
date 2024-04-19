<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Bengkel;
use App\Models\UjiEmisi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // seeder real user

        $bengkelNames = ['Astra Biz Daihatsu','Astra Daihatsu','Astra Daihatsu','Astra Isuzu','Auto 2000','Auto 2000','Auto 2000','Auto 2000','Auto 2000','Auto 2000','Mercedes Benz Bandung','Honda','Honda Autobest','Honda Bandung Center','Honda IBRM','Honda','Honda Sonic','Hyundai','Hyundai','KIA Siloam Motor','Konjaya','Levin Motor Sport','MG Motor Bandung','Mobil Care Auto service','Nissan Indosentosa Trada','Nissan','Nusantara Jaya Sentosa','Nusantara Jaya Sentosa','Nusantara Jaya Sentosa','Nusantara Jaya Sentosa','Panca Gemilang','Personal Motor','Plaza Toyota','Sampurna Motor','Speedy Tune Up Shop','Srikandi Diamond Motor','SS Performance Shop','Star Subur','Subur Ban','Sunda Fortuna','Super Shop & drive','Surya Putra Sarana','Surya Putra Sarana','Tunas BMW','Tunas Daihatsu','Tunas Daihatsu','Tunas Toyota','Tunas Toyota','Tunas Toyota','Universal Auto service','Wicaksana Berlian Motor','Wijaya','Wijaya Motor','Wuling Kumala Bandung','Wuling','Mazda','Plaza Subaru Bandung','Plaza Mini Bandung','Chery Setiabudhi Bandung','VW Audi Bandung','Nusantara Jaya Sentosa','Astra Daihatsu'];

        $bengkelUsernames = ['astrabizdaihatsu','astradaihatsuaa','astradaihatsucbr','astraisuzu','auto2000aa','auto2000cb','auto2000pas','auto2000st','auto2000sh','auto2000sc','mercedesbenzbandung','hondaay','hondaautobest','hondabandungcenter','hondaibrmcmh','hondapas','hondasonic','hyundaichm','hyundaish','kiasiloammotor','konjaya','levinmotorsport','mgmotorbandung','mobilcareautoservice','nissanindosentosatrada','nissanvtr','nusantarajayasentosa','nusantarajayasentosa','nusantarajayasentosa','nusantarajayasentosa','pancagemilang','personalmotor','plazatoyota','sampurnamotor','speedytuneupshop','srikandidiamondmotor','ssperformanceshop','starsubur','suburban','sundafortuna','supershop&drive','suryaputrasaranaas','suryaputrasaranasd','tunasbmw','tunasdaihatsush','tunasdaihatsuay','tunastoyotags','tunastoyotacim','tunastoyotakc','universalautoservice','wicaksanaberlianmotor','wijayadago','wijayamotor','wulingkumalabandung','wulingsh','mazdaaa','plazasubarubandung','plazaminibandung','cherysetiabudhibandung','vwaudibandung','nusantarajayasentosa','astradaihatsust'];
        
        $bengkelPasswords = ['soekarnohatta438','asiaafrika127','rayacibeureum42','soekarnohatta438','asiaafrika125','soekarnohatta759','drdjunjunan192','setiabudi68','soekarnohatta145','phhmustafano6','soekarnohatta727','ahmadyani352','soekarnohatta517','cicendono18','rayacimindi88','drjunjunan168b','soekarnohatta368','cihampelas6','soekarnohatta625','soekarnohatta471','trs.jalanjakarta32','khatulistiwa6b','buahbatu302','jend.gatotsubroto176','soekarnohatta382','veteran51-55','ayani259','soekarnohatta513','soekarnohatta289','soekarnohatta700','peta261','batunggalindahix11','pelajarpejuang45','martadinata122','burangrang33','soekarnohatta342','wr.supratman40','soekarnohatta319','peta71','vandeventer3','ayani281','abdurahmansaleh4','jendralsudirman5','soekarnohatta725a','soekarnohatta725b','jendahmadyani229','gatotsubroto109','rayacilember276','terusankiaracondong47','cihampelas203','ayani225','juanda131','ayani336','bkr27','soekarnohatta729a','asiaafrika154','pelajarpejuang45','pelajarpejuang45','setiabudhi65','soekarnohatta291','soekarnohatta291','setiabudi176'];
        
        $bengkelCabang = ['-','Asia Afrika','Cibeureum','-','Asia Afrika','Cibiru','Pasteur','Setiabudi','Soekarno Hatta','Suci','-','Ahmad Yani','-','-','Cimahi','Pasteur','-','Cihampelas','Soekarno Hatta','-','-','-','-','-','-','Veteran','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','Abdurrahman Saleh','Sudirman','-','Soekarno Hatta','Ahmad Yani','Gatot Subroto','Cimindi','Kiara Condong','-','-','Dago','-','-','Soekarno Hatta','Asia Afrika','-','-','-','-','-','Setiabudi'];

        $bengkelAlamat = ['Jl. Soekarno Hatta 438 D Kav 1','Jl. Asia Afrika No 127','Jl. Raya Cibeureum No 42','Jl. Soekarno Hatta 438 D Kav 1','Jl. Asia Afrika No 125','Jl. Soekarno Hatta 759','Jl. Dr Djunjunan 192','Jl. Setiabudi 68','Jl. Soekarno Hatta 145','Jl. PHH Mustafa No 6','Jl. Soekarno Hatta 727','Jl. Ahmad Yani 352','Jl. Soekarno Hatta 517','Jl. Cicendo No 18','Jl. Raya Cimindi No.88','Jl. Dr Junjunan 168 B','Jl. Soekarno Hatta No.368','Jl. Cihampelas No 6','Jl. Soekarno Hatta 625','Jl. Soekarno Hatta No.471','Jl. Trs. Jalan Jakarta 32','Jl. Khatulistiwa No. 6 B','Jl. Buah Batu No.302','Jl. Jend. Gatot Subroto 176-178','Jl. Soekarno Hatta 382','Jl Veteran 51 - 55','Jl. Jend A. Yani 259','Jl. Soekarno Hatta 513','Jl. Soekarno Hatta 289','Jl. Soekarno Hatta 700','Jl. Peta 261','Jl. Batunggal Indah IX No.11','Jl. Pelajar Pejuang 45 No 103','Jl. RE Martadinata 122','Jl. Burangrang No 33','Jl. Soekarno Hatta No 342','Jl. WR.Supratman No 40','Jl. Soekarno Hatta 319','Jl. Peta - Lingkar selatan No 71','Jl. Vandeventer No 3','Jl. A Yani 281','Jl. Abdurahman Saleh No 4','Jl. Jendral Sudirman No 5','Jl. Soekarno Hatta No. 725 A','Jl. Soekarno Hatta No 725 B','Jl. Jend Ahmad Yani 229','Jl. Gatot Subroto 109 - 111','Jl. Raya Cilember 276','Jl. Terusan Kiara Condong 47','Jl. Cihampelas 203','Jl Jend A Yani 225 -227','Jl. Ir. H. Juanda No 131','Jl. Jend. Ahmad Yani No 336','Jl. BKR No.27','Jl. Soekarno Hatta No. 729A','Jl. Asia Afrika No.154','Jl. Pelajar Pejuang 45 No 47','Jl. Pelajar Pejuang 45 No 47','Jl. Dr. Setiabudhi No.65','Jl. Soekarno Hatta No. 291','Jl. Soekarno Hatta No. 291','Jl. Dr. Setiabudi No.176'];

        $bengkelCount = count($bengkelNames);
        $usernameCount = count($bengkelUsernames);
        $passwordCount = count($bengkelPasswords);
        $cabangCount = count($bengkelCabang);
        $alamatCount = count($bengkelAlamat);

        $totalCount = max($bengkelCount, $usernameCount, $passwordCount, $alamatCount);


        for ($index = 0; $index < $totalCount; $index++) {
            User::create([
                'username' => $bengkelUsernames[$index % $usernameCount],
                'password' => Hash::make($bengkelPasswords[$index % $passwordCount]), // You may change this if needed
                'bengkel_name' => $bengkelNames[$index % $bengkelCount],
                'perusahaan_name' => $bengkelCabang[$index % $cabangCount], // ini diisi cabang buat display di kiri
                'kepala_bengkel' => '-',
                'jalan' => $bengkelAlamat[$index % $alamatCount], // alamat masuk sini semua aja
                'kab_kota' => '-',
                'kecamatan' => '-',
                'kelurahan' => '-',
                'alat_uji' => '-',
                'tanggal_kalibrasi_alat' => now(),
                'remember_token' => Str::random(10),
            ]);
        }


        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'bengkel_name' => 'Administrator',
            'perusahaan_name' => '-',
            'kepala_bengkel' => 'Saka Media Satwika',
            'jalan' => 'Sauyunan',
            'kab_kota' => 'Bandung',
            'kecamatan' => 'Panyileukan',
            'kelurahan' => 'Cipadung Kidul',
            'alat_uji' => 'Gasboard-5020 Automobile Emission Gas Analyzer',
            'tanggal_kalibrasi_alat' => today(),
            'is_admin' => true,
        ]);
        
        User::create([
            'username' => 'dinasdlh',
            'password' => bcrypt('dlhbandung'),
            'bengkel_name' => 'DLH',
            'perusahaan_name' => 'Kota Bandung',
            'kepala_bengkel' => '-',
            'jalan' => 'Jl. Sadang Tengah No.4-6',
            'kab_kota' => '-',
            'kecamatan' => '-',
            'kelurahan' => '-',
            'alat_uji' => '-',
            'user_kategori' => 'dinas',
            'tanggal_kalibrasi_alat' => today(),
            'is_admin' => false,
        ]);

        User::create([
            'username' => 'dinasdishub',
            'password' => bcrypt('dishubbandung'),
            'bengkel_name' => 'Dishub',
            'perusahaan_name' => 'Kota Bandung',
            'kepala_bengkel' => '-',
            'jalan' => 'Rancabolang',
            'kab_kota' => '-',
            'kecamatan' => '-',
            'kelurahan' => '-',
            'alat_uji' => '-',
            'user_kategori' => 'dinas',
            'tanggal_kalibrasi_alat' => today(),
            'is_admin' => false,
        ]);

        // Kendaraan::factory(40)->create(); //

        // UjiEmisi::factory(40)->create();

    }
}
