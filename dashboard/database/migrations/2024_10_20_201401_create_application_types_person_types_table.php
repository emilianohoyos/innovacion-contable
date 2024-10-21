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
        Schema::create('application_types_person_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('application_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('person_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_types_person_types', function (Blueprint $table) {
            $table->dropForeign(['application_type_id']);
        });
        Schema::table('application_types_person_types', function (Blueprint $table) {
            $table->dropForeign(['person_type_id']);
        });
        Schema::dropIfExists('application_types_person_types');
    }
};
