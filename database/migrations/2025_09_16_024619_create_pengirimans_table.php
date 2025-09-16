<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengiriman')->unique();
            $table->date('tanggal_pengiriman');
            $table->string('asal');
            $table->string('tujuan');
            $table->enum('status', ['tertunda','perjalanan','tiba'])->default('tertunda');
            $table->text('detail_barang');
            $table->foreignId('armada_id')->constrained('armadas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
