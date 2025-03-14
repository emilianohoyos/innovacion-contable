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
        Schema::table('apply_types', function (Blueprint $table) {
            $table->string('priority')->nullable();
            $table->string('destiny')->after('priority')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_types', function (Blueprint $table) {
            $table->dropColumn(['priority', 'destiny']);
        });
    }
};
