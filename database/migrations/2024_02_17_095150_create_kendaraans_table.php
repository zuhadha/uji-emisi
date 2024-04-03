<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujiemisi_id')->nullable();
            $table->foreignId('user_id');
            $table->string('nopol');
            $table->string('merk');
            $table->string('tipe');
            $table->integer('cc');
            $table->integer('tahun');
            $table->integer('kendaraan_kategori');
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('bahan_bakar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
