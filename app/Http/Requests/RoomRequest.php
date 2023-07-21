<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'beds_count' => ['required', 'integer', 'min:1', 'max:5'],
            'price_per_night' => ['required', 'decimal:10,0'],
            'special_properties' => ['nullable', 'array'],
            'special_properties.*.id' => ['required', 'exists:special_properties,id'],
            'special_properties.*.value' => ['required', 'string', 'max:255']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
