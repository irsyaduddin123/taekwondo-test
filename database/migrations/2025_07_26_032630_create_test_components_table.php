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
        Schema::create('test_components', function (Blueprint $table) {
            $table->id();
            $table->string('nama_komponen');
            $table->string('jenis'); // komponen fisik atau teknik
            $table->text('deskripsi')->nullable(); // deskripsi komponen (opsional)
            $table->timestamps();
            // ['fisik', 'teknik']
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_components');
    }
};
