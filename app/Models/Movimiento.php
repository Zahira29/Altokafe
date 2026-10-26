<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $primaryKey = 'id_movimiento';
    public $timestamps = false;

    protected $fillable = [
        'fecha_hora',
        'id_inventario',
        'id_almacen',
        'id_usuario',
        'id_tipo_movimiento',
        'id_registro_lote',
        'cantidad',
        'motivo_observacion'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'fecha_hora' => 'datetime'
    ];

    public function inventario(): BelongsTo
    {
        return $this->belongsTo(Inventario::class, 'id_inventario', 'id_inventario');
    }

    public function almacen(): BelongsTo
    {
        return $this->belongsTo(Almacen::class, 'id_almacen', 'id_almacen');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function tipoMovimiento(): BelongsTo
    {
        return $this->belongsTo(TipoMovimiento::class, 'id_tipo_movimiento', 'id_tipo_movimiento');
    }

    public function registroLote(): BelongsTo
    {
        return $this->belongsTo(RegistroLote::class, 'id_registro_lote', 'id_registro_lote');
    }
}
