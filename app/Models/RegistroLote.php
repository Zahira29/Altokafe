<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegistroLote extends Model
{
    protected $table = 'registro_lotes';
    protected $primaryKey = 'id_registro_lote';
    public $timestamps = false;

    protected $fillable = [
        'codigo_lote',
        'id_proveedor',
        'id_catador',
        'fecha_registro',
        'puntaje',
        'estado_catacion',
        'observaciones'
    ];

    protected $casts = [
        'puntaje' => 'decimal:2',
        'estado_catacion' => 'boolean',
        'fecha_registro' => 'datetime'
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    public function catador(): BelongsTo
    {
        return $this->belongsTo(Catador::class, 'id_catador', 'id_catador');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'id_registro_lote', 'id_registro_lote');
    }
}
