<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','descripcion','fecha','hora','cancha','user_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
