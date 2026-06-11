<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrashData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trash_data';

    protected $fillable = [
        'user_id',
        'data_id',
        'trash_type',
        'weight',
        'date',
        'location',
        'image',
        'description',
        'status',
        'price_per_kg',
        'total_price',
        'admin_note',
    ];

    protected $casts = [
        'weight' => 'float',
        'date' => 'date',
        'price_per_kg' => 'float',
        'total_price' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Status: pending, approved, rejected
    public function approve($pricePerKg, $adminNote = null)
    {
        $this->status = 'approved';
        $this->price_per_kg = $pricePerKg;
        $this->total_price = $this->weight * $pricePerKg;
        $this->admin_note = $adminNote;
        $this->save();

        // Update user saldo
        if ($this->user) {
            $this->user->saldo = ($this->user->saldo ?? 0) + $this->total_price;
            $this->user->save();

            // Send notification to user
            \App\Models\Notification::sendToUser(
                $this->user->id,
                'Setoran Disetujui! ✓',
                "Setoran sampah {$this->trash_type} ({$this->weight} kg) Anda telah disetujui. Rp " . number_format($this->total_price, 0) . " telah ditambahkan ke saldo Anda.",
                'success',
                'fa-check-circle',
                $this
            );
        }

        // Update gudang inventory
        $this->updateGudang();
    }

    public function reject($adminNote = null)
    {
        $this->status = 'rejected';
        $this->admin_note = $adminNote;
        $this->save();

        // Send notification to user
        if ($this->user) {
            \App\Models\Notification::sendToUser(
                $this->user->id,
                'Setoran Ditolak ✕',
                "Setoran sampah Anda ({$this->trash_type}, {$this->weight} kg) ditolak. Alasan: {$adminNote}",
                'error',
                'fa-times-circle',
                $this
            );
        }
    }

    // Auto-update gudang when approved
    private function updateGudang()
    {
        // Map trash_type to gudang kategori
        $kategoris = [
            'Sampah Organik' => 'Organik',
            'Sampah Plastik' => 'Plastik',
            'Sampah Kertas' => 'Kertas',
            'Sampah Logam' => 'Logam',
            'Sampah Kaca' => 'Kaca',
        ];

        $kategori = $kategoris[$this->trash_type] ?? 'Lainnya';

        // Cek apakah sudah ada record di gudang
        $gudang = Gudang::where('kategori', $kategori)->first();

        if ($gudang) {
            // Update existing record
            $gudang->stok = ($gudang->stok ?? 0) + $this->weight;
            $gudang->berat = ($gudang->berat ?? 0) + $this->weight;
            $gudang->save();
        } else {
            // Create new record
            Gudang::create([
                'nama_sampah' => $this->trash_type,
                'kategori' => $kategori,
                'berat' => $this->weight,
                'stok' => $this->weight,
                'harga' => $this->price_per_kg,
                'status' => 'Tersedia',
            ]);
        }
    }
}

