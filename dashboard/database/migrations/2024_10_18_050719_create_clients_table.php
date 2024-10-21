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
            $table->string('nit');
            $table->string('company_name');
            $table->string('address');
            $table->boolean('vat_responsible');
            $table->boolean('is_selfretaining');
            $table->boolean('is_simple_taxation_regime');
            $table->boolean('is_ica_withholding_agent');
            $table->string('municipality_ica_withholding_agent');
            $table->boolean('is_ica_selfretaining_agent');
            $table->string('municipality_ica_selfretaining_agent');
            $table->string('observation');
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

        Schema::dropIfExists('clients');
    }
};
