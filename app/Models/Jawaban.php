<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    protected $fillable = [
        'id_kuisioner', 'id_jawaban', 'id_pasien', 'jenis_test',
    ];

    public function kuisioner() {
        return $this->belongsTo(Kuisioner::class, 'id_kuisioner');
    }

    
    public function pasien() {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
