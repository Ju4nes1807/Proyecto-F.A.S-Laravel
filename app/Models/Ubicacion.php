<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicacions';
    public function escuelas()
    {
        return $this->hasMany(Escuela::class);
    }

    public function canchas()
    {
        return $this->hasMany(Cancha::class, 'fk_ubicacion_id');
    }
}
