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
            'titulo' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'tipoOferta' => 'required|string|max:50',

            // Relaciones (ajustadas según tu modelo)
            'idTipoInmueble' => 'required|exists:tipo_inmuebles,id',
            'idMunicipio' => 'required|exists:municipios,id',
            'idBarrio' => 'required|exists:barrios,id',
            'idUsuario' => 'required|exists:usuarios,id',

            // Campos numéricos opcionales
            'precio' => 'nullable|numeric|min:0',
            'precioAdministracion' => 'nullable|numeric|min:0',
            'area' => 'nullable|numeric|min:0',

            // Campos enteros opcionales
            'nHabitaciones' => 'nullable|integer|min:0, max:5',
            'nBaños' => 'nullable|integer|min:0, max:5',
            'nPiso' => 'nullable|integer|min:0',
            'pisoNumero' => 'nullable|integer|min:0',

            // Campos de texto
            'descripcion' => 'nullable|string|max:1000',
            'estadoPublicacion' => 'required|string|max:50',

            // Fechas
            'fechaPublicacion' => 'required|date',

            // Imágenes
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'tipoOferta.required' => 'Debe seleccionar un tipo de oferta.',
            
            'idTipoInmueble.exists' => 'El tipo de inmueble seleccionado no existe.',
            'idTipoInmueble.required' => 'Debe seleccionar un tipo de inmueble.',
            
            'nHabitaciones.min' => 'El número no debe ser negativo.',
            'nHabitaciones.max' => 'El maximo de habitaciones es 5.',

            'nBaños.min' => 'El número no debe ser negavito.',
            'nBaños.max' => 'El maximo de baños es 5.',

            'idMunicipio.exists' => 'El municipio seleccionado no existe.',
            'idMunicipio.required' => 'Debe seleccionar un municipio.',
            
            'idBarrio.exists' => 'El barrio seleccionado no existe.',
            'idBarrio.required' => 'Debe seleccionar un Barrio.',
            
            'idUsuario.exists' => 'El usuario seleccionado no existe.',
            'idUsuario.required' => 'Debe seleccionar un Usuario.',
            
            'estadoPublicacion.required' => 'Debe seleccionar un estado para la publicación.',
            'fechaPublicacion.required' => 'Debe ingresar una fecha de publicación.',
            'fechaPublicacion.date' => 'La fecha de publicación no es válida.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen válida.',
            'imagenes.*.max' => 'Las imágenes no deben superar los 2 MB.',
        ];
    }
}
