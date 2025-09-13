<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'fecha_nacimiento',
        'email',
        'telefono',
        'fk_role_id',
        'escuela_id',
        'password',
    ];

    protected $with = ['rol'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'fk_role_id');
    }

    public function escuelas()
    {
        return $this->hasMany(Escuela::class, 'user_id'); // Admin dueño
    }

    // User.php
    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'escuela_id');
    }

    // User.php
    public function asignaciones()
    {
        return $this->hasMany(\App\Models\Asignacion::class, 'user_id');
    }

    public function categorias()
    {
        return $this->hasManyThrough(Categoria::class, Asignacion::class, 'user_id', 'id', 'id', 'categoria_id');
    }

}
