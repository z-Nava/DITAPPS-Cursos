<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'contenido',
        'semestre_id',
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }

    

}
