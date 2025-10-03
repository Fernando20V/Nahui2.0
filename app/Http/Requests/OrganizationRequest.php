<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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

            'name' => 'required|string|max:255|min:3',
            'type' => 'required|string|max:100|min:3',
            'contact_info' => 'required|string|max:255|min:3',
            'address' => 'nullable|string|max:255|min:3',
            'website' => 'nullable|string|max:255|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la organización es requerida.',
            'name.string' => 'El nombre de la organización solo permite caracteres.',
            'name.max' => 'El nombre de la organización no puede tener mas de 255 caracteres.',
            'name.min' => 'El nombre de la organización debe tener al menos 3 caracteres.',

            'type.required' => 'El tipo de organización es requerido.',
            'type.string' => 'El tipo de organización solo permite caracteres.',
            'type.max' => 'El tipo de organización no puede tener mas de 100 caracteres.',
            'type.min' => 'El tipo de organización debe tener al menos 3 caracteres.',

            'contact_info.required' => 'La información del contacto es requerida.',
            'contact_info.string' => 'La información de contacto solo permite caracteres.',
            'contact_info.max' => 'La información del contacto no permite mas de 255 caracteres.',
            'contact_info.min' => 'La información del contacto debe de tener almenos 3 caracteres.',

            'address.required' => 'La dirección de la organización es requerida.',
            'address.string' => 'La dirección de la organización solo permite caracteres.',
            'address.max' => 'La dirección de la organización no puede tener mas de 255 caracteres.',
            'address.min' => 'La dirección de la organización debe de tener almenos 3 caracteres.',


            'website.string' => 'El sitio web solo permite caracteres.',
            'website.max' => 'El sitio web no puede tener mas de 255 caracteres.',
            'website.min' => 'El sitio web debe tener almenos 3 caracteres.',

		
        ];
    }
}
