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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identification');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('cellphone');
            $table->string('email');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
        });
        Schema::dropIfExists('employees');
    }
};
