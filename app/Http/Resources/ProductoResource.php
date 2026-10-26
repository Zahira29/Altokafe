<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'IdProducto'    => $this->IdProducto,
            'IdCategoria'   => $this->IdCategoria,
            'Nombre'        => $this->Nombre,
            'Descripcion'   => $this->Descripcion,
            'Precio'        => $this->Precio,
            'TiempoPrepMin' => $this->TiempoPrepMin,
            'Disponible'    => (bool) $this->Disponible,
            // solo aparecen si el controlador cargó la relación
            'categoria'     => $this->whenLoaded('categoria', fn () => $this->categoria->NombreCategoria),
            'ingredientes'  => $this->whenLoaded('ingredientes', fn () => $this->ingredientes->map(fn ($i) => [
                'IdIngrediente'     => $i->IdIngrediente,
                'Nombre'            => $i->Nombre,
                'UnidadMedida'      => $i->UnidadMedida,
                'CantidadRequerida' => $i->pivot->CantidadRequerida,
            ])),
        ];
    }
}
