<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consumo extends Model
{
    protected $table = 'consumos';
    protected $primaryKey = 'id_consumo';
    public $timestamps = false;

    protected $fillable = [
        'nombre_bebida',
        'id_inventario_insumo',
        'gramos_por_taza',
        'descripcion'
    ];

    protected $casts = [
        'gramos_por_taza' => 'decimal:2'
    ];

    public function inventarioInsumo(): BelongsTo
    {
        return $this->belongsTo(Inventario::class, 'id_inventario_insumo', 'id_inventario');
    }
}
