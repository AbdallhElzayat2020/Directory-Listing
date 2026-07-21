<?php

namespace App\Http\Requests\Admin\Listing;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id', 'integer'],
            'location_id' => ['required', 'exists:locations,id', 'integer'],
            'package_id' => ['nullable', 'exists:packages,id', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:3000'],
            'thumbnail_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:3000'],
            'title' => ['required', 'string', 'max:255', 'unique:listings,title,' . $this->listing],
            'description' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:500'],
            'facebook_link' => ['nullable', 'url', 'max:255'],
            'x_link' => ['nullable', 'url', 'max:255'],
            'instagram_link' => ['nullable', 'url', 'max:255'],
            'linkedin_link' => ['nullable', 'url', 'max:255'],
            'whatsapp_link' => ['nullable', 'url', 'max:255'],
            'google_map_embed_code' => ['nullable', 'string'],
            'attachments' => ['nullable', 'file', 'mimes:pdf,jpg,png,jpeg,zip', 'max:10000'],

            'amenities' => ['required', 'array'],
            'amenities.*' => ['exists:amenities,id'],
            'expired_date' => ['required', 'date'],
            'status' => ['required', 'string', 'in:active,inactive'],
            'is_verified' => ['required', 'in:yes,no'],
            'is_featured' => ['required', 'in:yes,no'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
