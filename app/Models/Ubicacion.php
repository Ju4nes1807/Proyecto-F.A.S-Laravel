<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    public function escuelas()
    {
        return $this->hasMany(Escuela::class);
    }
}
