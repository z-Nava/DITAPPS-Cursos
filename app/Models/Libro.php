<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'descripcion',
        'archivo',
        
        'archivo_url'
    ];

   

    public function getArchivoExtensionAttribute()
    {
    return pathinfo($this->archivo, PATHINFO_EXTENSION);
    }
}
