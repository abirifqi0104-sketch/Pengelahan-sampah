<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'information';

    protected $fillable = [
        'title',
        'content',
        'category',
        'image',
        'created_by',
        'views',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
