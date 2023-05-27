<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Libro;
use App\Http\Controllers\LibroController;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->text('descripcion');
            $table->string('archivo');
            $table->string('archivo_url')->nullable();
            $table->timestamps();

        });

        $libroController = new LibroController();
        $datosLibros = $libroController->obtenerDatosLibros();

         foreach ($datosLibros as $datos) {
        // Obtener el usuario por su ID o algún otro criterio
        $usuario = User::find($datos['user_id']);

        if ($usuario) {
            // Crear el libro en el base de datos
            $libro = new Libro();
            $libro->titulo = $datos['titulo'];
            $libro->autor = $datos['autor'];
            $libro->descripcion = $datos['descripcion'];

            // Guardar el archivo
            $archivo = $datos['archivo'];
            $rutaArchivo = $archivo->store('libros', 'public');
            $libro->archivo = $rutaArchivo;

            // Asociar el libro al usuario
            $libro->user_id = $usuario->id;

            $libro->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
