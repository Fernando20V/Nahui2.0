<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRentalRequest extends FormRequest
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
            'rental_status' => 'required|string|max:100|min:3',
            'pickup_location' => 'required|string|max:255|min:3',
            'dropoff_location' => 'required|string|max:255|min:3',
            'car_type' => 'required|string|max:100|min:3',
            'organization_id' => 'required',
            'rental_price' => 'required',
            'rental_duration' => 'required|string|max:100|min:3',
        ];
    }


    public function messages(): array
        {
            return [
                'rental_status.required' => 'El estado del alquiler del auto es requerido.',
                'rental_status.string' => 'El estado del alquiler del auto solo permite caracteres.',
                'rental_status.max' => 'El estado del alquiler del auto no puede tener mas de 100 caracteres.',
                'rental_status.min' => 'El estado del alquiler del auto debe tener al menos 3 caracteres.',

                'pickup_location.required' => 'El lugar de recogida del auto es requerido.',
                'pickup_location.string' => 'El lugar de recogida del auto solo permite caracteres.',
                'pickup_location.max' => 'El lugar de recogida del auto no puede tener mas de 255 caracteres.',
                'pickup_location.min' => 'El lugar de recogida del auto debe tener al menos 3 caracteres.',

                'dropoff_location.required' => 'El lugar de devolución es requerido.',
                'dropoff_location.string' => 'El lugar de devolución solo permite caracteres.',
                'dropoff_location.max' => 'El lugar de devolución no puede tener mas de 255 caracteres.',
                'dropoff_location.min' => 'El lugar de devolución debe tener al menos 3 caracteres.',

                'car_type.required' => 'El tipo de auto es requerido.',
                'car_type.string' => 'El tipo de auto solo permite caracteres.',
                'car_type.max' => 'El tipo de auto no puede tener mas de 100 caracteres.',
                'car_type.min' => 'El tipo de auto debe tener al menos 3 caracteres.',

                'organization_id.required' => 'La organización del alquiler de auto es requerida.',

                'rental_price.required' => 'El precio del alquiler es requerido.',

                'rental_duration.required' => 'La duración del alquiler del auto es requerida.',
                'rental_duration.string' => 'La duración del alquiler del auto solo permite caracteres.',
                'rental_duration.max' => 'La duración del alquiler del auto no puede tener mas de 100 caracteres.',
                'rental_duration.min' => 'La duración del alquiler del auto debe tener al menos 3 caracteres.',
            ];
        }
}
