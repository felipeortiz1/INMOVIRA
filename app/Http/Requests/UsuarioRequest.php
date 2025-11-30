<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nombre'        => 'required', 'string', 'max:45',
            'email'         => 'required', 'email', 'max:45', 'unique:usuarios,email',
            'telefono'      => 'required', 'string', 'max:12',
            'tipoUsuario'   => 'required', 'in:persona,inmobiliaria',

            // Si tipoUsuario es inmobiliaria, nombreEmpresa es requerido
            'nombreEmpresa' => 'nullable','string','max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser válido.',
            'nombre.max'      => 'El nombre no puede superar 45 caracteres.',

            'email.required'  => 'El email es obligatorio.',
            'email.email'     => 'Debe proporcionar un email válido.',
            'email.max'       => 'El email no puede exceder 45 caracteres.',
            'email.unique'    => 'Este correo ya está en uso por otro usuario.',

            'telefono.required' => 'El número de teléfono es obligatorio.',
            'telefono.max'      => 'El teléfono no puede exceder 12 caracteres.',

            'tipoUsuario.required' => 'Debe seleccionar un tipo de usuario.',
            'tipoUsuario.in'       => 'Tipo de usuario no válido.',

            'nombreEmpresa.max' => 'El nombre de la empresa no puede exceder 50 caracteres.',
        ];
    }
}
