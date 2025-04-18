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
        Schema::create('monthly_accounting_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('monthly_accounting_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accounting_answers', function (Blueprint $table) {
            $table->dropForeign(['monthly_accounting_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('monthly_accounting_answers');
    }
};
