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
        Schema::create('sections', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID
            $table->string('title', 255); // Título de la sección
            $table->text('content'); // Contenido de la sección
            $table->integer('order'); // Orden de la sección en el post
            $table->uuid('post_id'); // ID del post al que pertenece la sección
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Asegurar que el orden de las secciones por post sea único
            $table->unique(['post_id', 'order']);

            // Definición de la clave foránea
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Relación con 'posts'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
