<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'fecha_entrega', 'archivo', 'archivo_url', 'modulo_id'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
