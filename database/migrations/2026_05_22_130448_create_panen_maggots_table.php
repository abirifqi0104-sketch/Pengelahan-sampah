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
    Schema::create('panen_maggots', function (Blueprint $table) {

        $table->id();

        $table->foreignId('maggot_id')
              ->references('id')
              ->on('maggot_cultivations')
              ->onDelete('cascade');

        $table->date('tanggal_panen');

        $table->integer('hasil_kg');

        $table->text('keterangan')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panen_maggots');
    }
};
