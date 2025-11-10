<?php

namespace App\Http\Requests\Api\Comment;

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
            'body' => 'required|string|unique:comments,body,' . $this->comment->id,
            'author' => 'required|integer|unique:comments,author',
            'post' => 'required|integer|unique:comments,post',
            'parent' => 'nullable|integer',
            'likes' => 'nullable|integer',
        ];
    }
}
