<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
//            'title' => ['sometimes', 'required', 'string', 'max:255', 'unique:categories,title,' . $this->route('category') . ',id',],
            'title' => ['sometimes', 'required', 'string', 'max:255', 'unique:categories,title,' . $this->category],
            'icon_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:2000'],
            'status' => ['nullable', 'in:active,inactive'],
            'description' => ['nullable', 'string', 'max:2000'],
            'show_at_home' => ['required', 'in:yes,no'],
            'bg_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:3000'],
        ];
    }
}
