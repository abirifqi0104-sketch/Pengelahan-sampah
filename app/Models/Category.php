<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_kg',
    ];

    protected $casts = [
        'price_per_kg' => 'decimal:2',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

