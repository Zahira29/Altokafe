<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;

    protected $fillable = [
        'nombre_finca',
        'contacto',
        'telefono',
        'ubicacion'
    ];

    public function lotes(): HasMany
    {
        return $this->hasMany(RegistroLote::class, 'id_proveedor', 'id_proveedor');
    }
}
