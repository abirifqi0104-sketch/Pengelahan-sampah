<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trash_data', function (Blueprint $table) {

            $table->string('status')->default('Menunggu Verifikasi');

            $table->double('price_per_kg')->default(0);

            $table->double('total_price')->default(0);

            $table->text('admin_note')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('trash_data', function (Blueprint $table) {

            $table->dropColumn([
                'status',
                'price_per_kg',
                'total_price',
                'admin_note'
            ]);

        });
    }
};