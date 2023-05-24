<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'estado', 'user_id'];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
