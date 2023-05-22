<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $fillable = ['calificacion', 'fecha_calificacion', 'actividad_id', 'usuario_id'];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
