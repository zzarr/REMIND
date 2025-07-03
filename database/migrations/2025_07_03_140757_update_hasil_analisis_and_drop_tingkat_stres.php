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
    // Step 1: Drop foreign key constraints
    Schema::table('hasil_analisis', function (Blueprint $table) {
        $table->dropForeign(['hasil_pretest']);
        $table->dropForeign(['hasil_posttest']);
    });

    // Step 2: Modify the columns (change to string)
    Schema::table('hasil_analisis', function (Blueprint $table) {
        $table->string('hasil_pretest')->nullable()->change();
        $table->string('hasil_posttest')->nullable()->change();
    });

    // Step 3: Drop the table tingkat_stres
    Schema::dropIfExists('tingkat_stres');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke foreign key seperti semula
        Schema::create('tingkat_stres', function (Blueprint $table) {
            $table->id();
            $table->string('nama_level');
            $table->integer('nilai_min');
            $table->integer('nilai_max');
            $table->timestamps();
        });

        Schema::table('hasil_analisis', function (Blueprint $table) {
            // Ubah kembali kolom string ke foreignId
            $table->unsignedBigInteger('hasil_pretest')->nullable()->change();
            $table->unsignedBigInteger('hasil_posttest')->nullable()->change();

            // Tambahkan foreign key kembali
            $table->foreign('hasil_pretest')->references('id')->on('tingkat_stres')->onDelete('cascade');
            $table->foreign('hasil_posttest')->references('id')->on('tingkat_stres')->onDelete('cascade');
        });
    }
};
