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
        Schema::create('document_types_person_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('document_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('person_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_types_person_types', function (Blueprint $table) {
            $table->dropForeign(['person_type_id']);
        });
        Schema::table('document_types_person_types', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
        });
        Schema::dropIfExists('document_types_person_types');
    }
};
