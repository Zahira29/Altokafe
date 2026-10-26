<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catador extends Model
{
    protected $table = 'catadores';
    protected $primaryKey = 'id_catador';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'numero_movil',
        'direccion',
        'certificacion_grado'
    ];

    public function lotes(): HasMany
    {
        return $this->hasMany(RegistroLote::class, 'id_catador', 'id_catador');
    }
}
