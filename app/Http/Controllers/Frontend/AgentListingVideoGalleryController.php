<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingVideoGallery;
use App\Models\Subscription;
use App\Rules\MaxVideos;
use Illuminate\Http\Request;

class AgentListingVideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Listing $listing)
    {
        $videos = $listing->videos;
        $user = auth()->user();

        if ($listing->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $subscription = Subscription::with(['package'])
            ->where('user_id', $user->id)
            ->first();

        return view('frontend.dashboard.listings.videoGallery.index',
            compact('listing', 'videos', 'user', 'subscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Listing $listing)
    {
        $videoId = extractYoutubeId($request->video_url);

        if (!$videoId) {
            return back()->withErrors([
                'video_url' => 'Invalid YouTube URL.'
            ]);
        }

        $request->validate([
            'video_url' => ['required', 'url', new MaxVideos($listing->id)],
        ]);

        $listing->videos()->create([
            'video_url' => $videoId,
        ]);
        return redirect()->back()->with('success', 'Video added successfully.');
    }

    public function destroy(Listing $listing, ListingVideoGallery $video)
    {
        if ($listing->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        try {

            $listing->videos()->findOrFail($video->id)->delete();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'deleted successfully.');
    }
}
