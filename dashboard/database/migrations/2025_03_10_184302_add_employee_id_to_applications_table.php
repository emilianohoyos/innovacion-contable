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

        Schema::table('applications', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()
                ->constrained('employees') // Referencia a la tabla `users`
                ->cascadeOnDelete(); // Si se elimina el usuario, se eliminan sus aplicaciones

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['employee_id']); // Elimina la relación
            $table->dropColumn('employee_id');    // Elimina el campo
        });
    }
};
