<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel users (nasabah yang menyetor)
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        
        // Data inputan dari User
        $table->string('jenis_sampah');
        $table->double('perkiraan_berat'); // Inputan nasabah
        $table->string('foto_bukti');
        
        // Data yang diisi oleh Admin saat verifikasi
        $table->double('berat_riil')->nullable(); // Ditimbang asli oleh admin
        $table->double('harga_per_kg')->nullable();
        $table->double('total_harga')->nullable(); // berat_riil * harga_per_kg
        $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
        $table->text('admin_note')->nullable(); // Catatan opsional jika ditolak
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
