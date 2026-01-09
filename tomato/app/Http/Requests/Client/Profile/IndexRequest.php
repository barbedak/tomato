<?php

namespace App\Http\Requests\Client\Profile;

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
            'filter.name' => 'nullable|string',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'filter' => [
                'name' => $this->filter['name'] ?? '',
            ]
        ]);
    }
}
