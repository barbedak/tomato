<?php

namespace App\Http\Requests\Api\Message;

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
            'chat' => 'required|integer',
            'author' => 'required|integer',
            'body' => 'nullable|string',
            'answer' => 'required|string',
            'repost' => 'required|string',
        ];
    }
}
