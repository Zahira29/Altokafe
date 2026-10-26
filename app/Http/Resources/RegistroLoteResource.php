<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistroLoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_registro_lote' => $this->id_registro_lote,
            'codigo_lote' => $this->codigo_lote,
            'fecha_registro' => $this->fecha_registro ? $this->fecha_registro->format('Y-m-d H:i') : null,
            'puntaje' => $this->puntaje,
            'estado_catacion' => $this->estado_catacion ? 'Catado' : 'Pendiente',
            'proveedor' => [
                'id_proveedor' => $this->proveedor->id_proveedor ?? null,
                'nombre_finca' => $this->proveedor->nombre_finca ?? 'Sin Proveedor',
                'contacto' => $this->proveedor->contacto ?? null,
            ],
            'catador' => [
                'id_catador' => $this->catador->id_catador ?? null,
                'nombre' => $this->catador ? $this->catador->nombre . ' ' . $this->catador->apellido : 'Por Asignar',
            ]
        ];
    }
}
