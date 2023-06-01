<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'titulo',
        'contenido',
        'fecha_entrega',
        'fecha_inicio',
        'url',
        'archivo',
        'archivo_url',
        'tema_id',
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }


}
