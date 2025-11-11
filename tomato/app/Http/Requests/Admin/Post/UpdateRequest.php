<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Storage;

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
            'post.title' => 'required|string',
            'post.body' => 'nullable|string',
            'post.category_id' => 'required|integer|exists:categories,id',
            'post.profile_id' => 'required|integer|exists:profiles,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|file|max:5000|mimes:jpg,jpeg,png',
            'tags' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
        //добавление значений, чтобы их провалидировать в rules()
    {
        return $this->merge([
            'post' => [
                ...$this->post,
                'profile_id' => auth()->user()->profile->id,
            ],
        ]);
    }

    protected function passedValidation()
//        добавление значений после валидации
//    в контроллере нужно использовать validationData() вместо validated()
    {
//        $imagePaths = [];
//        if (array_key_exists('images', $this->validated())){
//            foreach ($this->images as $image) {
//                $imagePaths[] = Storage::disk('public')->put('/images', $image);
//            }
//        }
//        return $this->merge([
//            'image_paths' => $imagePaths,
//        ]);
//; для одного файла

    }
}
