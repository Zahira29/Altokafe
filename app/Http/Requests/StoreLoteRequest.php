<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoteRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'codigo_lote' => 'required|string|unique:registro_lotes,codigo_lote',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'puntaje' => 'nullable|numeric|between:0,100',
            'estado_catacion' => 'boolean',
            'observaciones' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo_lote.required' => 'El código de lote es obligatorio.',
            'codigo_lote.unique' => 'Este código de lote ya se encuentra registrado.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe.',
        ];
    }
}
