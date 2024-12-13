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
        Schema::create('monthly_accounting_folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('monthly_accounting_id')->constrained()->cascadeOnDelete();
            $table->foreignId('folder_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_new')->default(true);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accounting_folders', function (Blueprint $table) {
            $table->dropForeign(['monthly_accounting_id']);
            $table->dropForeign(['folder_id']);
        });
        Schema::dropIfExists('monthly_accounting_folders');
    }
};
