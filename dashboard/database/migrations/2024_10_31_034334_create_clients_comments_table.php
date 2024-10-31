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
        Schema::create('clients_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients_comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('clients_comments', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });
        Schema::dropIfExists('clients_comments');
    }
};
