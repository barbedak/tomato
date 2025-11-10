<?php

namespace App\Http\Requests\Api\Group;

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
            'title' => 'required|string|unique:groups,title',
            'author' => 'required|integer|unique:groups,author',
            'description' => 'nullable|string',
            'members' => 'nullable|string',
            'avatar' => 'nullable|string',
        ];
    }
}
