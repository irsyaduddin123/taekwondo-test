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
        // tabel master jenis komponen
        Schema::create('component_types', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis'); // contoh: fisik, teknik, psikologis
            $table->timestamps();
        });

        // tabel komponen tes
        Schema::create('test_components', function (Blueprint $table) {
            $table->id();
            $table->string('nama_komponen');
            $table->foreignId('jenis_id')
                  ->constrained('component_types')
                  ->cascadeOnDelete(); 
            $table->text('deskripsi')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_components');
        Schema::dropIfExists('component_types');
    }
};
