<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingSchedule;
use Illuminate\Support\Str;
use function Termwind\render;

class ListingController extends Controller
{

    public function viewAll()
    {
        $listings = Listing::with(['user', 'location', 'category'])->active()->approved()->paginate(6);
        return view('frontend.pages.all-listings', [
            'listings' => $listings,
        ]);
    }


    public function listings(string $slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        $listings = $category->listings()
            ->active()
            ->approved()
            ->with(['location', 'category']);

        if (request()->filled('search')) {
            $search = request('search');

            $listings->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")

                    ->orWhere('description', 'like', "%{$search}%")

                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    })

                    ->orWhereHas('location', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $listings = $listings->paginate(6)->withQueryString();

        return view('frontend.pages.category-listing', [
            'listings' => $listings,
            'category' => $category,
        ]);
    }

    public function viewDetails(string $slug)
    {
        $listing = Listing::with(['user', 'location', 'category', 'images', 'videos', 'amenities'])
            ->whereSlug($slug)
            ->firstOrFail();

        $similarListings = Listing::active()
            ->approved()
            ->where('category_id', $listing->category->id)
            ->where('id', '!=', $listing->id)->limit(4)->get();

        $images = $listing->images;
        $amenities = $listing->amenities;
        $videos = $listing->videos;
        return view('frontend.pages.listing-details', [
            'listing' => $listing,
            'images' => $images,
            'amenities' => $amenities,
            'videos' => $videos,
            'similarListings' => $similarListings,
        ]);
    }

    public function showModal(string $id)
    {
        $listing = Listing::findOrFail($id);
        return view('frontend.layouts.ajax-listing-modal', compact('listing'))->render();
    }
}
