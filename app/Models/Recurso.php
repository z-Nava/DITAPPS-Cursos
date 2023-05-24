<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'titulo',
        'contenido',
        'url',
        'tema_id',
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }


}
