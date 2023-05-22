<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $fillable = ['contenido', 'archivo', 'archivo_url', 'actividad_id', 'alumno_id'];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }
}
