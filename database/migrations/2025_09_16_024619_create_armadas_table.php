<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_armada')->unique();
            $table->string('jenis_kendaraan');
            $table->unsignedInteger('kapasitas');
            $table->enum('status', ['tersedia','tidak tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armadas');
    }
};
