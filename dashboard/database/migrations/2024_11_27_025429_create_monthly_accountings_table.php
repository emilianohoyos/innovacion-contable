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
        Schema::create('monthly_accountings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year')->unsigned();
            $table->integer('month')->unsigned()->check('month >= 1 AND month <= 12');
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accountings', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('monthly_accountings');
    }
};
