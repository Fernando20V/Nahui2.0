<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRouteRequest extends FormRequest
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
			'short_name' => 'string',
			'long_name' => 'required|string',
			'scope' => 'required|string',
			'service_pattern' => 'required|string',
			'is_active' => 'required',
        ];
    }
}
