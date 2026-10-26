<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlmacenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'sometimes|required|string|max:100',
            'direccion' => 'sometimes|required|string|max:255',
            'capacidad' => 'sometimes|required|integer|min:1',
        ];
    }
}
