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
        Schema::create('logs', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID
            $table->string('user_email', 255); // Email del usuario
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade'); // Establecemos la clave foránea
            $table->string('action', 255); // Acción realizada
            $table->string('description', 255)->nullable(); // Descripción de la acción (opcional)
            $table->string('ip', 255)->nullable(); // Dirección IP del usuario (opcional)
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
