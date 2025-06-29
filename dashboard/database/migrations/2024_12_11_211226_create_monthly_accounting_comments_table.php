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
        Schema::create('monthly_accounting_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('monthly_accounting_folder_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('user_type');
            $table->string('comment', 1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accounting_comments', function (Blueprint $table) {
            $table->dropForeign(['monthly_accounting_folder_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('monthly_accounting_comments');
    }
};
