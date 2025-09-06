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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
