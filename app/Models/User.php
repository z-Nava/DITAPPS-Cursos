<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
        'phone',
        'status', // 'unverified', 'verified'
        'about',
        'rol_id',
        'password_confirmation'
    ];
    protected $attributes = [
        'rol_id' => 2,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'alumnos', 'usuario_id', 'curso_id');
    }

    public function participantesCurso()
    {
        return $this->belongsToMany(Curso::class, 'participantes_curso', 'usuario_id', 'curso_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'usuario_id');
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'alumno_id');
    }


}
