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
        Schema::create('apply_doc_type_folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('apply_document_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('folder_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_doc_type_folders', function (Blueprint $table) {
            $table->dropForeign(['apply_document_type_id']);
            $table->dropForeign(['folder_id']);
        });
        Schema::dropIfExists('apply_doc_type_folders');
    }
};
