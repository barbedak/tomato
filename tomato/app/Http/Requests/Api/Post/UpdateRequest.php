<?php

namespace App\Http\Requests\Api\Post;

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
            'title' => 'required|string|unique:posts,title,' . $this->post->id,
            'description' => 'nullable|string',
            'tag' => 'nullable|string',
            'category' => 'nullable|string',
            'author' => 'nullable|string',
            'body' => 'nullable|string',
            'published_at' => 'nullable|date_format:Y-m-d H:i:s',
            'is_published' => 'nullable|boolean',
            'status' => 'nullable|integer'
        ];
    }
}
