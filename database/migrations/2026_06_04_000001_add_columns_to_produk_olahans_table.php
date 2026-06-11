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
        Schema::table('produk_olahans', function (Blueprint $table) {
            // Tambahkan kolom yang belum ada
            if (!Schema::hasColumn('produk_olahans', 'nama_produk')) {
                $table->string('nama_produk')->nullable();
            }
            if (!Schema::hasColumn('produk_olahans', 'harga')) {
                $table->decimal('harga', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('produk_olahans', 'stok')) {
                $table->decimal('stok', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('produk_olahans', 'foto')) {
                $table->string('foto')->nullable();
            }
            if (!Schema::hasColumn('produk_olahans', 'deskripsi')) {
                $table->text('deskripsi')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_olahans', function (Blueprint $table) {
            if (Schema::hasColumn('produk_olahans', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
            if (Schema::hasColumn('produk_olahans', 'foto')) {
                $table->dropColumn('foto');
            }
            if (Schema::hasColumn('produk_olahans', 'stok')) {
                $table->dropColumn('stok');
            }
            if (Schema::hasColumn('produk_olahans', 'harga')) {
                $table->dropColumn('harga');
            }
            if (Schema::hasColumn('produk_olahans', 'nama_produk')) {
                $table->dropColumn('nama_produk');
            }
        });
    }
};
