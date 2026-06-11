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
    Schema::create('gudangs', function (Blueprint $table) {

        $table->id();

        $table->string('nama_sampah');

        $table->string('kategori');

        $table->decimal('berat', 10, 2);

        $table->integer('stok');

        $table->decimal('harga', 10, 2)->nullable();

        $table->string('status')->default('Tersedia');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudangs');
    }
};
