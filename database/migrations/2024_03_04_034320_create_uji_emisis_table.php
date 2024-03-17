<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uji_emisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id');
            $table->foreignId('user_id');
            $table->integer('odometer');
            $table->float('co');
            $table->float('hc');
            $table->float('opasitas')->nullable();
            $table->float('co2')->nullable();
            $table->float('co_koreksi')->nullable();
            $table->float('o2')->nullable();
            $table->float('putaran')->nullable();
            $table->float('temperatur')->nullable();
            $table->float('lambda')->nullable();
            $table->timestamp('tanggal_uji')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_emisis');
    }
};
