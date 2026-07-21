<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateListingScheduleRequest extends FormRequest
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
        $listingId = $this->route('listing')->id;
        $scheduleId = $this->route('schedule')->id;

        return [
            'day' => [
                'required',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                Rule::unique('listing_schedules')
                    ->where('listing_id', $listingId)
                    ->where('status', 'active')
                    ->ignore($scheduleId)
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
            'start_time.date_format' => 'Please enter a valid time format.',
            'end_time.required' => 'End time is required.',
            'end_time.after' => 'End time must be after start time.',
            'status.required' => 'Status is required.',
            'status.in' => 'Please select a valid status.',
        ];
    }
}
