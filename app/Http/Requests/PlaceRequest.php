<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:2000',
            'coordenadas' => 'nullable|string|max:255',
            'servicios' => 'nullable|string|max:255',
            'habitaciones' => 'nullable|integer|min:0',
            'capacidad' => 'nullable|integer|min:0',
            'reglas' => 'nullable|string|max:2000',
            'entrance_fee' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'promocion' => 'nullable|string|max:255',
            'is_public' => 'nullable|boolean',
            'is_managed' => 'nullable|boolean',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120', // max 5MB por imagen

            // 🔹 Campos nuevos para coordenadas
            'longitude' => 'nullable|numeric|between:-180,180',
            'latitude'  => 'nullable|numeric|between:-90,90',
        ];
    }

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
            // name
            'name.required' => 'El nombre del lugar es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',

            // categoria
            'categoria.string' => 'La categoría debe ser texto.',
            'categoria.max' => 'La categoría no puede superar los 100 caracteres.',

            // description
            'description.string' => 'La descripción debe ser texto.',
            'description.max' => 'La descripción no puede superar los 2000 caracteres.',

            // coordenadas
            'coordenadas.string' => 'Las coordenadas deben ser texto.',
            'coordenadas.max' => 'Las coordenadas no pueden superar los 255 caracteres.',

            // 🔹 Mensajes para longitude y latitude
            'longitude.numeric' => 'La longitud debe ser un valor numérico.',
            'longitude.between' => 'La longitud debe estar entre -180 y 180.',
            'latitude.numeric'  => 'La latitud debe ser un valor numérico.',
            'latitude.between'  => 'La latitud debe estar entre -90 y 90.',

            // servicios
            'servicios.string' => 'Los servicios deben ser texto.',
            'servicios.max' => 'Los servicios no pueden superar los 255 caracteres.',

            // habitaciones
            'habitaciones.integer' => 'El número de habitaciones debe ser un número entero.',
            'habitaciones.min' => 'El número de habitaciones no puede ser negativo.',

            // capacidad
            'capacidad.integer' => 'La capacidad debe ser un número entero.',
            'capacidad.min' => 'La capacidad no puede ser negativa.',

            // reglas
            'reglas.string' => 'Las reglas deben ser texto.',
            'reglas.max' => 'Las reglas no pueden superar los 2000 caracteres.',

            // entrance_fee
            'entrance_fee.numeric' => 'El precio debe ser un valor numérico.',
            'entrance_fee.min' => 'El precio no puede ser negativo.',

            // currency
            'currency.string' => 'La moneda debe ser texto.',
            'currency.max' => 'La moneda no puede superar los 10 caracteres.',

            // promocion
            'promocion.string' => 'La promoción debe ser texto.',
            'promocion.max' => 'La promoción no puede superar los 255 caracteres.',

            // is_public / is_managed
            'is_public.boolean' => 'El campo "Público" debe ser verdadero o falso.',
            'is_managed.boolean' => 'El campo "Gestionado" debe ser verdadero o falso.',

            // imagenes
            'imagenes.*.image' => 'Cada archivo debe ser una imagen válida.',
            'imagenes.*.mimes' => 'Solo se permiten imágenes JPG, JPEG, PNG, GIF o WEBP.',
            'imagenes.*.max' => 'Cada imagen no puede superar los 5MB.',
        ];
    }
}
