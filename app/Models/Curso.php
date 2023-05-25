<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin', 'estado', 'imagen', 'imagen_url', 'user_id'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'curso_usuario', 'curso_id', 'user_id');
    }


    public function semestres()
    {
        return $this->hasMany(Semestre::class);
    }
}
