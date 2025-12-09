<?php

namespace App\Http\Requests\Client\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepostRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'profile_id' => 'required|integer|exists:profiles,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'category_id' => $this->post->category_id,
            'profile_id' => auth()->user()->profile->id,
        ]);
    }
}
