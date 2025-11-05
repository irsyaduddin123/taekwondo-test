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
        // Tambahkan nilai 'coach' ke enum kolom 'role'
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'user', 'coach') DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum semula jika migrasi di-rollback
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'user') DEFAULT 'user'");
    }
};
