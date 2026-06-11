<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_sampah',
        'perkiraan_berat',
        'berat_riil',
        'harga_per_kg',
        'total_harga',
        'foto_bukti',
        'status',
        'admin_note'
    ];

    // Relasi: Transaksi ini milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}