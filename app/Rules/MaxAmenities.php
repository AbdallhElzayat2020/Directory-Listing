<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class MaxAmenities implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $packageAmenitiesLimit = Auth::user()->subscription->package->number_of_amenities;

        // Unlimited
        if ($packageAmenitiesLimit === -1) {
            return;
        }

        if (count($value) > $packageAmenitiesLimit) {
            $fail('You have exceeded the maximum number of amenities allowed for your subscription package..');
        }


    }
}
