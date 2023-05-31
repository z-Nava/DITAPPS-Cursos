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
        'user_id',
        'calificacion',
        'archivo_url',
    ];

    // Relación con Recurso
    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }

    // Relación con User
    public function alumno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function respuestasUsuario()
    {
        return $this->hasMany(RespuestaUsuario::class, 'user_id', 'user_id')
                 ->where('recurso_id', $this->recurso_id);
    }


}
