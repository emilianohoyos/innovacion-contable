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
        Schema::create('apply_doc_type_folder_monthly_accountings', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Definir claves foráneas con nombres personalizados
            $table->unsignedBigInteger('apply_doc_type_folder_id');
            $table->unsignedBigInteger('monthly_accounting_id');

            $table->foreign('apply_doc_type_folder_id', 'folder_monthly_folder_id_fk')
                ->references('id')->on('apply_doc_type_folders')
                ->cascadeOnDelete();

            $table->foreign('monthly_accounting_id', 'folder_monthly_accounting_id_fk')
                ->references('id')->on('monthly_accountings')
                ->cascadeOnDelete();

            $table->string('attachments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_doc_type_folder_monthly_accountings', function (Blueprint $table) {
            $table->dropForeign('folder_monthly_folder_id_fk'); // Eliminar la clave foránea personalizada
            $table->dropForeign('folder_monthly_accounting_id_fk'); // Eliminar la clave foránea personalizada
        });
        Schema::dropIfExists('apply_doc_type_folder_monthly_accountings');
    }
};
