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
        Schema::create('tingkat_stres', function (Blueprint $table) {
            $table->id();
            $table->string('nama_level'); // Contoh: Rendah, Sedang, Tinggi
            $table->integer('nilai_min'); // Dalam persen, misal: 0
            $table->integer('nilai_max'); // Dalam persen, misal: 32
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_stres');
    }
};
