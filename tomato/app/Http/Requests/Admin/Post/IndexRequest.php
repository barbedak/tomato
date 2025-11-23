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
            'filter.title' => 'nullable|string',
//            'filter.category_id' => 'nullable|integer|exists:categories,id',
            'filter.category_title' => 'nullable|string',
            'filter.published_at_to' => 'nullable||date_format:Y-m-d H:i:s',
            'filter.published_at_from' => 'nullable||date_format:Y-m-d H:i:s',
            'filter.views_from' => 'nullable|integer',
            'filter.views_to' => 'nullable|integer',

            'pagination.page' => 'required|integer',
            'pagination.per_page' => 'required|integer',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'filter' => [
                'title' => $this->filter['title'] ?? '',
            ],

            'pagination' => [
                'page' => $this->pagination['page'] ?? 1,
                'per_page' => $this->pagination['per_page'] ?? 5,
            ]
        ]);
    }
}
