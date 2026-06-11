<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukOlahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 
        'harga', 
        'stok', 
        'foto',
        'deskripsi'
    ];

    protected $casts = [
        'harga' => 'float',
        'stok' => 'float',
    ];
}