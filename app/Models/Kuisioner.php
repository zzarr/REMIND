<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    use HasFactory;

    protected $table = 'kuisioner';

    protected $fillable = [
        'pertanyaan',
        'is_positive'
    ];

    public function jawaban(){
        return $this->hasMany(Jawaban::class, 'id_kuisioner');
    }

    
}
