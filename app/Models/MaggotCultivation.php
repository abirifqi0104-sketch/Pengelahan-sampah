<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaggotCultivation extends Model
{
    use HasFactory;

    // PASTIKAN BARIS INI ADA DAN TULISANNYA SAMA DENGAN DI DATABASE:
    protected $table = 'maggot_cultivations'; 

    protected $fillable = [
        'cultivation_code',
        'biopond_name',
        'initial_weight',
        'unit',
        'start_date',
        'status',
        'description',
    ];
}