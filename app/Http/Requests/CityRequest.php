<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'country-name' => ['required', 'string', 'min:1', 'max:200'],
            'population' => ['required', 'string', 'min:1', 'max:200'],
            'city-name' => ['required', 'string', 'min:1', 'max:200'],
            'latitude' => ['required', 'string', 'min:1', 'max:200'],
            'longitude' => ['required', 'string', 'min:1', 'max:200'],
            'capital' => ['required', 'string', 'min:1', 'max:200'],
        ];
    }
}
