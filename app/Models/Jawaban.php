<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    protected $fillable = [
        'id_kuisioner', 'id_pasien', 'nilai', 'jenis_test'
    ];

    public function kuisioner() {
        return $this->belongsTo(Kuisioner::class, 'id_kuisioner');
    }

    
    public function pasien() {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function getLabelAttribute()
    {
        $labels = [
            0 => 'Never',
            1 => 'Almost Never',
            2 => 'Sometimes',
            3 => 'Fairly Often',
            4 => 'Very Often',
        ];
        return $labels[$this->nilai] ?? '-';
    }

}
