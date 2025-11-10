<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'user_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'country' => 'nullable|string',
            'birthed_at_from' => 'nullable||date_format:Y-m-d',
            'birthed_at_to' => 'nullable||date_format:Y-m-d',
            'is_married' => 'nullable|boolean',
            'avatar' => 'nullable|string',
        ];
    }
}
