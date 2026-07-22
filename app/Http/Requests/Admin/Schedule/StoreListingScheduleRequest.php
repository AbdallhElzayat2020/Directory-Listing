<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreListingScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $listingId = $this->route('listing')->id;

        return [
            'day' => [
                'required',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                // منع إضافة نفس اليوم لنفس الـ Listing مع status = active
                Rule::unique('listing_schedules')
                    ->where('listing_id', $listingId)
                    ->where('status', 'active')
            ],
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'day.required' => 'Please select a day.',
            'day.in' => 'Please select a valid day.',
            'day.unique' => 'An active schedule already exists for this day.',
            'start_time.required' => 'Start time is required.',
            'start_time.date_format' => 'Please enter a valid time format (HH:MM).',
            'end_time.required' => 'End time is required.',
            'end_time.after' => 'End time must be after start time.',
            'status.required' => 'Status is required.',
            'status.in' => 'Please select a valid status.',
        ];
    }
}
