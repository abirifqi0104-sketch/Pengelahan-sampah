<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('maggot_cultivations', function (Blueprint $table) {
            $table->id();
            $table->string('cultivation_code')->unique(); // Contoh: CULT-2026-001
            $table->string('biopond_name'); // Contoh: Biopond Blok A-1
            $table->double('initial_weight', 8, 2); // Berat telur/bibit awal (kg/gram)
            $table->enum('unit', ['gram', 'kg'])->default('gram');
            $table->date('start_date');
            $table->enum('status', ['Penetasan', 'Larva', 'Prepupa', 'Pupa', 'Selesai'])->default('Penetasan');
            $table->text('description')->nullable(); // Catatan pakan dll
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maggot_cultivations');
    }
};