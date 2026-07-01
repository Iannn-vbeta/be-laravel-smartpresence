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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('work_unit_id')->nullable()->after('id')->constrained('work_units')->onDelete('set null');
        });

        Schema::dropIfExists('user_unit_kerja');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('user_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('unit_kerja_id')->constrained('work_units')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['work_unit_id']);
            $table->dropColumn('work_unit_id');
        });
    }
};
