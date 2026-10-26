<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'activo'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'activo' => 'boolean'
    ];
}
