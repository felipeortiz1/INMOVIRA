<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MunicipioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtener el ID del municipio para ignorar en el unique al editar
        $municipioId = $this->route('id');

        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('municipios', 'nombre')->ignore($municipioId),
            ],

            'codigoPostal' => [
                'required',
                'string',
                'size:6',
                Rule::unique('municipios', 'codigoPostal')->ignore($municipioId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del municipio es obligatorio.',
            'nombre.unique' => 'Este municipio ya está registrado.',

            'codigoPostal.required' => 'El código postal es obligatorio.',
            'codigoPostal.size' => 'El código postal debe tener exactamente 6 caracteres.',
            'codigoPostal.unique' => 'Este código postal ya está en uso.',
        ];
    }
}
