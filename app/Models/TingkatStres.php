<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatStres extends Model
{
    use HasFactory;

    protected $table = 'tingkat_stres';

    protected $fillable = [
        'nama_level',
        'nilai_min',
        'nilai_max'
    ];
}
