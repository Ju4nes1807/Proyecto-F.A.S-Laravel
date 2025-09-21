<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'fk_admin_id',
        'fk_categoria_id',
        'fk_ubicacion_id',
        'estado',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'fk_categoria_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'fk_admin_id');
    }

    public function escuelas()
    {
        return $this->belongsToMany(Escuela::class, 'escuela_torneo', 'fk_torneo_id', 'fk_escuela_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'fk_ubicacion_id');
    }

}
