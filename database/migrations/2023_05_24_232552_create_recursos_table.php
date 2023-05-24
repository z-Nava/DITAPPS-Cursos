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
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['foro', 'tarea', 'examen', 'enlace', 'video', 'archivo']);
            $table->string('titulo');
            $table->text('contenido')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('tema_id')->constrained('temas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};
