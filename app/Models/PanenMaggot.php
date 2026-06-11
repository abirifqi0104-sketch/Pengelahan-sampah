<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanenMaggot extends Model
{
    protected $fillable = [
        'maggot_id', // INI YANG TADI HILANG!
        'tanggal_panen',
        'hasil_kg',
        'keterangan'
    ];

    public function maggot()
    {
        return $this->belongsTo(MaggotCultivation::class, 'maggot_id');
    }
}