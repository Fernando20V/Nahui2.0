<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
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
			'title' => 'required|string',
			'description' => 'required|string',
			'floors' => 'required',
			'bedrooms' => 'required',
			'bathrooms' => 'required',
			'cats_allowed' => 'required',
			'dogs_allowed' => 'required',
			'status' => 'required|string',
			'view_count' => 'required',
        ];
    }
}
