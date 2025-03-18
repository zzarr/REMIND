<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'nama', 'usia', 'jenis_kelamin',
    ];

    public function jawabanPasien() {
        return $this->hasMany(Jawaban::class, 'id_pasien');
    }

    public function hasilAnalisis() {
        return $this->hasOne(HasilAnalisis::class, 'id_pasien');
    }
}
