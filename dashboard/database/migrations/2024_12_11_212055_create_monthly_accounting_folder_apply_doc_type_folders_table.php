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
        Schema::create('monthly_accounting_folder_apply_doc_type_folders', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Definimos manualmente el nombre de las claves foráneas para evitar el error "name is too long"
            $table->foreignId('monthly_accounting_folder_id')
                ->constrained('monthly_accounting_folders', 'id')
                ->cascadeOnDelete()
                ->index('fk_monthly_folder_id');

            $table->foreignId('apply_doc_type_folder_id')
                ->constrained('apply_doc_type_folders', 'id')
                ->cascadeOnDelete()
                ->index('fk_apply_doc_type_folder_id');

            $table->string('path');
            $table->boolean('is_new')->default(true);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accounting_folder_apply_doc_type_folders', function (Blueprint $table) {
            // Eliminamos manualmente las claves foráneas antes de borrar la tabla
            $table->dropForeign('fk_monthly_folder_id');
            $table->dropForeign('fk_apply_doc_type_folder_id');
        });

        Schema::dropIfExists('monthly_accounting_folder_apply_doc_type_folders');
    }
};
