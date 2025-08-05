<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Renombrar la columna status a is_active
        Schema::table('monthly_accounting_folders', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_new');
        });
        // Copiar valores existentes de status si es necesario (opcional, aquí se pone todo en 1)
        DB::table('monthly_accounting_folders')->update(['is_active' => 1]);
        // Eliminar la columna status
        Schema::table('monthly_accounting_folders', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_accounting_folders', function (Blueprint $table) {
            $table->string('status')->nullable();
        });
        // Opcional: restaurar valores si se requiere
        DB::table('monthly_accounting_folders')->update(['status' => 'active']);
        Schema::table('monthly_accounting_folders', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
