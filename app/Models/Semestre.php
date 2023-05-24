<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'estado', 'curso_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
