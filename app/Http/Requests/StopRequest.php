<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StopRequest extends FormRequest
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
			'name' => 'required|string',
			'lat' => 'required',
			'lng' => 'required',
			'is_terminal' => 'required',
			'is_active' => 'required',
        ];
    }
}
