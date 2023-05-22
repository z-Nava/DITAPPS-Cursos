<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipanteCurso extends Model
{
    use HasFactory;
    protected $fillable = ['usuario_id', 'curso_id'];
}
