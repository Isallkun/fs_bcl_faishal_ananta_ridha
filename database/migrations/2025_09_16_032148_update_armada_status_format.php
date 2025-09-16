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
        // Update existing data from 'tidak_tersedia' to 'tidak tersedia'
        DB::table('armadas')
            ->where('status', 'tidak_tersedia')
            ->update(['status' => 'tidak tersedia']);

        // Modify the enum column to include the new format
        DB::statement("ALTER TABLE armadas MODIFY COLUMN status ENUM('tersedia', 'tidak tersedia') DEFAULT 'tersedia'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Update existing data from 'tidak tersedia' back to 'tidak_tersedia'
        DB::table('armadas')
            ->where('status', 'tidak tersedia')
            ->update(['status' => 'tidak_tersedia']);

        // Revert the enum column to the old format
        DB::statement("ALTER TABLE armadas MODIFY COLUMN status ENUM('tersedia', 'tidak_tersedia') DEFAULT 'tersedia'");
    }
};
