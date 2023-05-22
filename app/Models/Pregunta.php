<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = ['enunciado', 'tipo', 'examen_id'];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function opcionesRespuesta()
    {
        return $this->hasMany(OpcionRespuesta::class);
    }
}
