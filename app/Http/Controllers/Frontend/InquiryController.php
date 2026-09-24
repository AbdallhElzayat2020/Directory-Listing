<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Listing\BookListing;
use App\Models\Inquiry;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    //
    public function book(BookListing $request, Listing $listing)
    {
        if ($listing->status !== 'active') {
            return redirect()->back()->with('error', 'This listing is not available for booking.');
        }

        if ($listing->user_id == Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to book this listing.');
        }

        // Create a new inquiry
        $data = $request->validated();

        $data['listing_id'] = $listing->id;
        $data['owner_id'] = $listing->user_id;
        $data['sender_id'] = Auth::id();

        Inquiry::create($data);

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');

    }
}
