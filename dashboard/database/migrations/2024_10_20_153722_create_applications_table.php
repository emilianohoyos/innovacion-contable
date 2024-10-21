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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('application_type_id')->constrained()->cascadeOnDelete();
            $table->text('observations');
            $table->timestamp('application_date');
            $table->timestamp('estimated_delevery_date');
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['application_type_id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('applications');
    }
};
