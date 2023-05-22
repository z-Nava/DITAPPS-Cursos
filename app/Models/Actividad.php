<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'fecha_creacion', 'modulo_id', 'usuario_id'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
