<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PhpParser\Builder\FunctionLike;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>['min:8'],
            'slug' =>['min:8', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',Rule::unique('posts')->ignore($this->route()->parameter('post'))],
            'content' =>[ 'required'],
            'category_id' =>[ 'required', Rule::exists('categories', 'id')],
            'tags' => ['array', Rule::exists('tags', 'id'), 'required'],
            'image' => ['image', 'max:2048'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->input('slug') ?: \Str::slug($this->input('title')),
        ]);
    }

}
