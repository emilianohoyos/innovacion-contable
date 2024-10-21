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
        Schema::create('history_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->timestamp('changed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_states', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
        });
        Schema::table('history_states', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('history_states', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
        });
        Schema::dropIfExists('history_states');
    }
};
