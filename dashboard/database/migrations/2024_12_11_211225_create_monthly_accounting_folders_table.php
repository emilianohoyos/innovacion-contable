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
            $table->foreignId('client_folder_id')->constrained()->cascadeOnDelete();
            $table->integer('month_year');
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
            $table->dropForeign(['client_folder_id']);
        });
        Schema::dropIfExists('monthly_accounting_folders');
    }
};
