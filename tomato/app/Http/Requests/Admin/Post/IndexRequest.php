<?php

namespace App\Http\Requests\Admin\Post;

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
            'title' => 'nullable|string',
//            'category_id' => 'nullable|integer|exists:categories,id',
            'category_title' => 'nullable|string',
            'published_at_to' => 'nullable||date_format:Y-m-d H:i:s',
            'published_at_from' => 'nullable||date_format:Y-m-d H:i:s',
            'views_from' => 'nullable|integer',
            'views_to' => 'nullable|integer',
        ];
    }
}
