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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID
            $table->string('title', 255); // Título del post
            $table->string('resume', 255); // Resumen del post
            $table->string('category_name', 255); // Nombre de la categoría
            $table->string('author', 255); // Autor del post (email)
            $table->enum('status', ['draft', 'published', 'archived']); // Estado del post
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // Definición de la clave foránea
            $table->foreign('category_name')->references('name')->on('categories')->onDelete('cascade'); // Relación con 'categories'
            $table->foreign('author')->references('email')->on('users')->onDelete('cascade'); // Relación con 'users'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
