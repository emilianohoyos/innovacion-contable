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
        Schema::create('month_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year')->unsigned();
            $table->integer('month')->unsigned()->check('month >= 1 AND month <= 12');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('month_configs');
    }
};
