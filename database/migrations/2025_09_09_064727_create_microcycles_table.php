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
        Schema::create('microcycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('minggu'); // 1 - 52
            $table->string('fase'); // Umum I, Khusus I, dll
            $table->string('tahap'); // Persiapan Umum, Kompetisi, Transisi
            $table->integer('load')->default(0); // intensitas
            $table->integer('phys_prep')->default(0);
            $table->integer('tech_prep')->default(0);
            $table->integer('volume')->default(0);
            $table->integer('intensity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('microcyles');
    }
};
