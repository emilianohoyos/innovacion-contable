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
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->nullable();
            $table->foreignId('application_id')->constrained()->cascadeOnDelete();
            $table->foreignId('apply_document_type_id')->constrained()->cascadeOnDelete();
            $table->string('another_document_type')->nullable();
            $table->string('attachment_type')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
        });
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign(['apply_document_type_id']);
        });

        Schema::dropIfExists('attachments');
    }
};
