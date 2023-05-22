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
        Schema::create('opciones_respuesta', function (Blueprint $table) {
            $table->id();
            $table->text('opcion');
            $table->boolean('es_correcta');
            $table->foreignId('pregunta_id')->constrained('preguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones_respuesta');
    }
};
