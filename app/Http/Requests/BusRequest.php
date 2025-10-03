<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
            'transport_status' => 'required|string|max:100|min:3',
            'departure_time' => 'required|time',
            'waiting_location' => 'required|string|max:255|min:3',
            'transport_type' => 'required|string|max:100|min:3',
            'organization_id' => 'required',
            'ticket_price' => 'required',
            'travel_duration' => 'required|string|max:100|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'transport_status.required' => 'El estado del transporte es requerido.',
            'transport_status.string' => 'El estado del transporte solo permite caracteres.',
            'transport_status.max' => 'El estado del transporte no puede tener mas de 100 caracteres.',
            'transport_status.min' => 'El estado del transporte debe tener al menos 3 caracteres.',

            'departure_time.required' => 'La hora de salida es requerida.',
            'departure_time.time' => 'La hora de salida debe ser una hora válida.',

            'waiting_location.required' => 'El lugar de espera del bus es requerido.',
            'waiting_location.string' => 'El lugar de espera del bus solo permite caracteres.',
            'waiting_location.max' => 'El lugar de espera del bus no puede tener mas de 255 caracteres.',
            'waiting_location.min' => 'El lugar de espera del bus debe tener al menos 3 caracteres.',

            'transport_type.required' => 'El tipo de transporte es requerido.',
            'transport_type.string' => 'El tipo de transporte solo permite caracteres.',
            'transport_type.max' => 'El tipo de transporte no puede tener mas de 100 caracteres.',
            'transport_type.min' => 'El tipo de transporte debe tener al menos 3 caracteres.',

            'organization_id.required' => 'La organización del bus es requerida.',

            'ticket_price.required' => 'El precio del boleto de bus es requerido.',

            'travel_duration.required' => 'La duración del viaje es requerida.',
            'travel_duration.string' => 'La duración del viaje solo permite caracteres.',
            'travel_duration.max' => 'La duración del viaje no puede tener mas de 100 caracteres.',
            'travel_duration.min' => 'La duración del viaje debe tener al menos 3 caracteres.',
        ];
    }



}
