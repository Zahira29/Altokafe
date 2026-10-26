<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre_finca' => 'required|string|max:150',
            'contacto' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'ubicacion' => 'nullable|string|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_finca.required' => 'El nombre de la finca es obligatorio.',
        ];
    }
}
