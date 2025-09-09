<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'user_id',
        'escuela_id',
        'assigned_by',
        'tipo',
    ];

    // Relación con usuario asignado
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con admin que asignó
    public function admin()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    // Relación con escuela
    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'escuela_id');
    }

}
;
