<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionRespuesta extends Model
{
    use HasFactory;

    protected $fillable = ['opcion', 'correcta', 'pregunta_id'];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
