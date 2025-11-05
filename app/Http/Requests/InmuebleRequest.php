<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InmuebleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idUsuario' => 'required|exists:usuarios,idUsuario',
            'idBarrio' => 'required|exists:barrios,idBarrio',
            'titulo' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'tipo_oferta' => 'required',
            'idTipoInmueble' => 'required|exists:tipos_inmueble,idTipoInmueble',
            'precio' => 'nullable|numeric',
            'precioAdministracion' => 'nullable|numeric',
            'area' => 'nullable|numeric',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
