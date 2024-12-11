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
        Schema::create('client_folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('folder_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_folders', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['folder_id']);
        });
        Schema::dropIfExists('client_folders');
    }
};
