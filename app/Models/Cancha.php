<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cancha extends Model
{
    use HasFactory;
    protected $table = 'canchas';
    protected $fillable = [
        'nombre',
        'tipo',
        'disponible',
        'descripcion',
        'direccion',
        'fk_escuela_id',
        'fk_admin_id',
        'fk_ubicacion_id',
    ];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'fk_escuela_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'fk_admin_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'fk_ubicacion_id');
    }
}
