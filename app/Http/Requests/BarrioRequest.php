<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarrioRequest extends FormRequest
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
            'nombre' => 'required', 'string', 'max:255',
            'idMunicipio' => 'required', 'exists:municipios,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del barrio es obligatorio.',
            'nombre.string' => 'El nombre del barrio debe ser un texto válido.',
            'nombre.max' => 'El nombre del barrio no puede superar los 255 caracteres.',

            'idMunicipio.required' => 'Debe seleccionar un municipio.',
            'idMunicipio.exists' => 'El municipio seleccionado no es válido.',
        ];
    }
}
