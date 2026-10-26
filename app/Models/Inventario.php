<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';
    public $timestamps = false;

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'tipo_cafe',
        'unidad_medida',
        'stock_actual'
    ];

    protected $casts = [
        'stock_actual' => 'decimal:2'
    ];

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'id_inventario', 'id_inventario');
    }
}
