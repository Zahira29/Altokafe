<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'IdCategoria'     => $this->IdCategoria,
            'NombreCategoria' => $this->NombreCategoria,
            'Descripcion'     => $this->Descripcion,
            'OrdenVisual'     => $this->OrdenVisual,
            'productos'       => $this->whenLoaded('productos', fn () => $this->productos->map(fn ($p) => [
                'IdProducto' => $p->IdProducto,
                'Nombre'     => $p->Nombre,
                'Precio'     => $p->Precio,
            ])),
        ];
    }
}
