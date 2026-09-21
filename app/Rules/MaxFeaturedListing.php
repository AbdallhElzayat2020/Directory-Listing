<?php

namespace App\Rules;

use App\Models\Listing;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class MaxFeaturedListing implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if ($value !== 'yes') {
            return;
        }
        $packageFeaturedListingLimit = Auth::user()->subscription->package->number_of_featured_listings;

        // Unlimited
        if ($packageFeaturedListingLimit === -1) {
            return;
        }

        $userFeaturedListingCount = Listing::where([
            'user_id' => Auth::user()->id,
            'status' => 'active',
            'is_featured' => 'yes',
        ])->count();

        if ($userFeaturedListingCount >= $packageFeaturedListingLimit) {
            $fail('You have exceeded the maximum number of featured listings allowed for your subscription package.');
        }

    }
}
