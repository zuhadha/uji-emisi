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
        Schema::create('alat__ujis', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('operate_time')->nullable();
            $table->string('calibration_time')->nullable();
            $table->string('supplier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat__ujis');
    }
};
