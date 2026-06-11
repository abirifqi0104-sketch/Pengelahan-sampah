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
        Schema::create('produk_olahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->decimal('harga', 12, 2)->default(0);
            $table->decimal('stok', 10, 2)->default(0);
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_olahans');
    }
};
