<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trash_data', function (Blueprint $table) {
            // Add user_id if not exists
            if (!Schema::hasColumn('trash_data', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('id');
            }
            // Add data_id if not exists
            if (!Schema::hasColumn('trash_data', 'data_id')) {
                $table->string('data_id')->unique()->nullable()->after('user_id');
            }
            // Add image if not exists
            if (!Schema::hasColumn('trash_data', 'image')) {
                $table->string('image')->nullable()->after('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trash_data', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'data_id', 'image']);
        });
    }
};
