<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'created_by',
    ];

    public function escuelas()
    {
        return $this->belongsToMany(Escuela::class, 'categoria_escuela');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function torneos()
    {
        return $this->hasMany(Torneo::class, 'fk_categoria_id');
    }

}
