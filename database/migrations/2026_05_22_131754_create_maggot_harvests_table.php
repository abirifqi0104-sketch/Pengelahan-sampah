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
    Schema::create('maggot_harvests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('maggot_cultivation_id')->constrained('maggot_cultivations')->onDelete('cascade');
        $table->double('total_panen'); // dalam Kg
        $table->double('alokasi_kering')->default(0); // Kg untuk pakan kering
        $table->double('alokasi_pupuk')->default(0);  // Kg untuk pupuk
        $table->double('alokasi_jual')->default(0);   // Kg dijual langsung
        $table->double('total_pendapatan')->default(0); // Jika ada yang dijual langsung
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maggot_harvests');
    }
};
