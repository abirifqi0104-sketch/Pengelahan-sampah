<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'amount',
        'bank_name',
        'account_number',
        'account_holder',
        'status',
        'admin_note',
        'approved_at',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approve($adminNote = null)
    {
        $this->status = 'approved';
        $this->admin_note = $adminNote;
        $this->approved_at = now();
        $this->save();

        // Send notification to user
        Notification::sendToUser(
            $this->user_id,
            'Permintaan Tarik Saldo Disetujui ✓',
            'Permintaan tarik saldo Anda sebesar Rp ' . number_format($this->amount, 0) . ' telah disetujui. Uang akan diproses dalam 1-3 hari kerja.',
            'success',
            'fa-check-circle',
            $this
        );
    }

    public function reject($adminNote = null)
    {
        $this->status = 'rejected';
        $this->admin_note = $adminNote;
        $this->save();

        // Refund saldo ke user
        if ($this->user) {
            $this->user->saldo += $this->amount;
            $this->user->save();
        }

        // Send notification to user
        Notification::sendToUser(
            $this->user_id,
            'Permintaan Tarik Saldo Ditolak ✕',
            'Permintaan tarik saldo Anda sebesar Rp ' . number_format($this->amount, 0) . ' ditolak. Alasan: ' . ($adminNote ?? 'Tidak ada keterangan'),
            'error',
            'fa-times-circle',
            $this
        );
    }

    public function process()
    {
        $this->status = 'processed';
        $this->processed_at = now();
        $this->save();

        // Send notification to user
        Notification::sendToUser(
            $this->user_id,
            'Tarik Saldo Berhasil Diproses ✓',
            'Tarik saldo Anda sebesar Rp ' . number_format($this->amount, 0) . ' telah berhasil diproses dan ditransfer ke rekening Anda.',
            'success',
            'fa-money-bill',
            $this
        );
    }
}
