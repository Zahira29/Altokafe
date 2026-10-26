<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'razon_social' => $this->razon_social,
            'ruc'          => $this->ruc,
            'email'        => $this->email,
        ];
    }
}
