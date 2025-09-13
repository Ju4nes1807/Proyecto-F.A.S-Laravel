<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Factories\HasFactory;

class Escuela extends Model
{
    use HasFactory;

    protected $table = 'escuelas';

    protected $fillable = [
        'nombre',
        'contacto',
        'correo',
        'direccion',
        'ubicacion_id',
        'user_id',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id'); // Dueño (admin)
    }

    public function usuarios()
    {
        return $this->hasMany(User::class, 'escuela_id'); // Entrenadores y jugadores asignados
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_escuela');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

}
