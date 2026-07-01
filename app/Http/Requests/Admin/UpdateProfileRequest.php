<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg,webp', 'max:3000'],
            'banner' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg,webp', 'max:3000'],
            'name' => ['required', 'string', 'max:255', 'unique:users,name,' . $this->user()->id],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:500'],
            'facebook_link' => ['nullable', 'url', 'max:200'],
            'x_link' => ['nullable', 'url', 'max:200'],
            'linkedin_link' => ['nullable', 'url', 'max:200'],
            'instagram_link' => ['nullable', 'url', 'max:200'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'about' => ['nullable', 'string', 'max:1000']
        ];
    }
}
