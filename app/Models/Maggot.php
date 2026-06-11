<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maggot extends Model
{
    use HasFactory;

    // Menyesuaikan dengan nama kolom di tabel database yang baru
    protected $fillable = [
        'cultivation_code',
        'biopond_name',
        'initial_weight',
        'unit',
        'start_date',
        'description',
        'status'
    ];

    // Relasi ke PanenMaggot
    public function panen()
    {
        return $this->hasMany(PanenMaggot::class, 'maggot_id');
    }
}