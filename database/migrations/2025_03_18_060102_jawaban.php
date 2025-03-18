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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kuisioner')->constrained('kuisioner')->onDelete('cascade');
            $table->foreignId('id_pasien')->constrained('pasien')->onDelete('cascade');
            $table->integer('nilai');
            $table->enum('jenis_test', ['pretest', 'posttest']);
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
