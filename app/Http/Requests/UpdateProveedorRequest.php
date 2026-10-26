<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('proveedor');

        return [
            'razon_social' => 'sometimes|required|string|max:150',
            'ruc' => 'sometimes|required|string|size:11|unique:proveedores,ruc,' . $id,
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ];
    }
}
