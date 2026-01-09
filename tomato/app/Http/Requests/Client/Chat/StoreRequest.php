<?php

namespace App\Http\Requests\Client\Chat;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'members' => 'required|array',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
           'members' => array_merge($this->members, [auth()->user()->profile->id])
        ]);
    }
}
