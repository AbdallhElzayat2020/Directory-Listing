<?php

namespace App\Http\Requests\Admin\Package;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
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
    protected function prepareForValidation(): void
    {
        // Auto-generate slug if it's not provided in the request
        if ($this->has('name') && !$this->has('slug')) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }
    }

    public function rules(): array
    {
        // Retrieve the current package instance from route parameter binding
        $packageId = $this->route('package')?->id ?? $this->route('package');

        return [
            'package_type' => ['required', Rule::in(['free', 'paid'])],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages', 'slug')->ignore($packageId)
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'number_of_days' => ['required', 'integer',],
            'number_of_listings' => ['required', 'integer',],
            'number_of_photos' => ['required', 'integer',],
            'number_of_videos' => ['required', 'integer',],
            'number_of_amenities' => ['required', 'integer',],
            'number_of_featured_listings' => ['required', 'integer',],
            'show_at_home' => ['required', Rule::in(['yes', 'no'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ];
    }

    /**
     * Custom attribute names for better validation error messages.
     */
    public function attributes(): array
    {
        return [
            'package_type' => 'package type is required',
            'number_of_days' => 'number of days for the package is required',
            'number_of_listings' => 'number of listings is required',
            'number_of_photos' => 'number of photos is required',
            'number_of_videos' => 'number of videos is required',
            'number_of_amenities' => 'number of amenities is required',
            'number_of_featured_listings' => 'number of featured listings is required',
            'show_at_home' => 'show at home option is required',
        ];
    }
}
