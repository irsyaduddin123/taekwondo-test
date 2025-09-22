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
        Schema::create('biomotor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->string('komponen'); // contoh: Kekuatan, Daya Tahan, Kecepatan
            $table->string('fase')->nullable(); // contoh: Foundation, Development
            $table->string('minggu')->nullable(); // minggu ke berapa
            $table->string('keterangan')->nullable(); // tambahan catatan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biomotor');
    }
};
