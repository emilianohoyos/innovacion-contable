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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Referencia al usuario que recibe la notificación
            $table->string('type'); // Tipo de notificación (ej., "alerta", "mensaje", "recordatorio")
            $table->string('title'); // Título breve de la notificación
            $table->text('message'); // Contenido de la notificación
            $table->string('link')->nullable(); // Enlace relacionado con la notificación (opcional)
            $table->boolean('is_read')->default(false); // Estado de lectura (leída o no leída)
            $table->timestamp('read_at')->nullable(); // Fecha y hora en que fue leída
            $table->timestamp('sent_at')->nullable(); // Fecha y hora de envío de la notificación
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('notifications');
    }
};
