<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaUsuario extends Model
{
    use HasFactory;
    protected $table = 'respuestas_usuarios';
    protected $fillable = ['pregunta_id', 'recurso_id', 'user_id', 'respuesta'];

     // Relación con Pregunta
     public function pregunta()
     {
         return $this->belongsTo(Pregunta::class);
     }

}
