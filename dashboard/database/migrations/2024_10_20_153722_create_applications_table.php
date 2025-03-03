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
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('apply_type_id')->constrained()->cascadeOnDelete();
            $table->text('observations');
            $table->timestamp('application_date');
            $table->timestamp('estimated_delevery_date');
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->string('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['apply_type_id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });

        Schema::dropIfExists('applications');
    }
};
