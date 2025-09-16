<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('pengiriman')) {
            Schema::rename('pengiriman', 'pengirimans');
        } elseif (Schema::hasTable('pengirimen')) {
            Schema::rename('pengirimen', 'pengirimans');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengirimans')) {
            // Pilih salah satu sesuai asalmu sebelumnya:
            // Schema::rename('pengirimans', 'pengiriman');
            Schema::rename('pengirimans', 'pengirimen');
        }
    }
};
