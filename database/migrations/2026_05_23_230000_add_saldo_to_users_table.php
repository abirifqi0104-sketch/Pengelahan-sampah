<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Saldo digunakan untuk menyimpan total setoran terverifikasi user.
            $table->decimal('saldo', 12, 2)->default(0)->after('role');
        });

        // Jika versi MySQL mengabaikan 'after' karena kolom role tidak ada,
        // migration tetap sukses karena kolom saldo tetap ditambahkan.
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });
    }
};

