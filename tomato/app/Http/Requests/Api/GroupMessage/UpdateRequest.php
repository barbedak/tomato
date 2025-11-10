<?php

namespace App\Http\Requests\Api\GroupMessage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group' => 'required|integer|unique:group_messages,group,'.$this->groupMessage->id,
            'author' => 'required|integer|unique:group_messages,author,'.$this->groupMessage->id,
            'body' => 'nullable|string',
            'answer' => 'required|string',
            'repost' => 'required|string',
        ];
    }
}
