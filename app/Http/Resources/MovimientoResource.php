<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovimientoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'IdMovimiento'   => $this->IdMovimiento,
            'IdIngrediente'  => $this->IdIngrediente,
            'ingrediente'    => $this->whenLoaded('ingrediente', fn () => $this->ingrediente->Nombre),
            'TipoMovimiento' => $this->TipoMovimiento,
            'Cantidad'       => $this->Cantidad,
            'Motivo'         => $this->Motivo,
            'FechaHora'      => $this->FechaHora,
        ];
    }
}
