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
    Schema::create('hasil_analisis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_pasien')->constrained('pasien')->onDelete('cascade');
        $table->integer('skor_pretest')->nullable();
        $table->dateTime('tanggal_pretest')->nullable(); // ditambahkan
        $table->foreignId('hasil_pretest')->constrained('tingkat_stres')->onDelete('cascade');
        $table->integer('skor_posttest')->nullable();
        $table->dateTime('tanggal_posttest')->nullable(); // ditambahkan
        $table->foreignId('hasil_posttest')->constrained('tingkat_stres')->onDelete('cascade');
        $table->text('kesimpulan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
