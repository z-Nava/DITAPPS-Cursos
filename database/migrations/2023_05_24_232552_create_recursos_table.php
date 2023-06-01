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
            $table->enum('tipo', ['actividad', 'tarea', 'examen', 'enlace', 'video', 'archivo']);
            $table->string('titulo');
            $table->text('contenido')->nullable();
            $table->string('url')->nullable();
            $table->string('archivo')->nullable();
            
            // $table->date('fecha_entrega')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
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
