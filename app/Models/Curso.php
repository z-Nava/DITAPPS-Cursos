<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin', 'estado', 'imagen', 'imagen_url'];

    public function profesores()
    {
        return $this->belongsToMany(User::class, 'profesores', 'curso_id', 'usuario_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'alumnos', 'curso_id', 'usuario_id');
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function examenes()
    {
        return $this->hasMany(Examen::class);
    }
}
