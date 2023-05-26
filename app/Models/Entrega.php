<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'descripcion',
        'archivo',
        'fecha_entrega',
        'recurso_id',
        'alumno_id',
    ];

    // Relación con Recurso
    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }

    // Relación con User
    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

}
