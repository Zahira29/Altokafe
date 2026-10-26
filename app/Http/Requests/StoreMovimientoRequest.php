<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'IdIngrediente' => 'required|integer|exists:Ingrediente,IdIngrediente',
            'TipoMovimiento' => 'required|in:Entrada,Salida',
            'Cantidad' => 'required|numeric|gt:0',
            'Motivo' => 'nullable|string|max:100',
        ];
    }
}
