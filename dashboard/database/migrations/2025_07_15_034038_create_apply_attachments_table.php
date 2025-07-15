<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('apply_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('path'); // Almacena la ruta del archivo adjunto
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // Opcional: created_at y updated_at

            // Índices adicionales para mejor rendimiento
            $table->index('application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('apply_attachments');
    }
};
