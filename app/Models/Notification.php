<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'icon',
        'notifiable_id',
        'notifiable_type',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function markAsRead()
    {
        if (!$this->read_at) {
            $this->read_at = now();
            $this->save();
        }
    }

    public static function sendToUser($userId, $title, $message, $type = 'info', $icon = 'fa-info-circle', $notifiable = null)
    {
        return self::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'icon' => $icon,
            'notifiable_id' => $notifiable?->id,
            'notifiable_type' => $notifiable ? get_class($notifiable) : null,
        ]);
    }
}
