<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['tipo'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'fk_role_id');
    }
}
