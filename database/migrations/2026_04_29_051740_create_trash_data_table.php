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
    Schema::create('trash_data', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->string('data_id')->unique(); // ID Setoran (misal: SETOR-12345)
        $table->string('trash_type'); // Jenis Sampah (Organik, Anorganik, dll)
        $table->double('weight');     // Berat (Kg)
        $table->date('date');         // Tanggal Setor
        $table->string('location');   // Lokasi TPS
        $table->string('image')->nullable(); // Foto sampah
        $table->text('description')->nullable(); // Keterangan tambahan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_data');
    }
};
