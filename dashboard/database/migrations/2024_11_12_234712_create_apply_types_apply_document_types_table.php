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
        Schema::create('apply_types_apply_document_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('apply_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('apply_document_type_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_required');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_types_apply_document_types', function (Blueprint $table) {
            $table->dropForeign(['apply_document_type_id']);
        });
        Schema::table('apply_types_apply_document_types', function (Blueprint $table) {
            $table->dropForeign(['apply_type_id']);
        });
        Schema::dropIfExists('apply_types_apply_document_types');
    }
};
