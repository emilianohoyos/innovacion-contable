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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('person_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade');
            $table->string('nit');
            $table->string('email');
            $table->string('company_name');
            $table->string('address');
            $table->boolean('vat_responsible')->default(false);
            $table->boolean('is_selfretaining')->default(false);
            $table->boolean('is_simple_taxation_regime')->default(false);
            $table->boolean('is_ica_withholding_agent')->default(false);
            $table->string('municipality_ica_withholding_agent')->nullable();
            $table->boolean('is_ica_selfretaining_agent')->default(false);
            $table->string('municipality_ica_selfretaining_agent')->nullable();
            $table->string('observation');
            $table->string('category');
            $table->string('review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['person_type_id']);
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('clients');
    }
};
