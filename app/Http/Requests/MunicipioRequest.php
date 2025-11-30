<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunicipioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255|unique:municipios,nombre',
            'codigoPostal' => 'required|string|size:6|unique:municipios,codigoPostal',
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
