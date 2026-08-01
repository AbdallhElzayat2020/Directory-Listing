<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\AgentListingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Listing\StoreAgentListingRequest;
use App\Http\Requests\Frontend\Listing\UpdateAgentListingRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Location;
use App\Traits\FileHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use function Termwind\render;

class AgentListingController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(AgentListingDataTable $dataTable): View|JsonResponse
    {
        $user = auth()->user();

        return $dataTable->render('frontend.dashboard.listings.index', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $categories = Category::active()->get();
        $locations = Location::active()->get();
        $amenities = Amenity::active()->get();
        return view('frontend.dashboard.listings.create', [
            'user' => $user,
            'locations' => $locations,
            'categories' => $categories,
            'amenities' => $amenities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentListingRequest $request)
    {
        $image = null;
        $thumbnail = null;
        $attachments = null;

        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $data['slug'] = Str::slug($request->title);
            $data['image'] = $this->uploadFile($request, 'image', $image, 'listings');
            $data['thumbnail_image'] = $this->uploadFile($request, 'thumbnail_image', $thumbnail, 'listings');
            $data['attachments'] = $this->uploadFile($request, 'attachments', $attachments, 'listings');

            $listing = Listing::create($data);

            $listing->amenities()->attach($data['amenities']);
            DB::commit();

            return to_route('user.listings.index')
                ->with('success', 'created successfully.');

        } catch (\Exception $exception) {

            DB::rollBack();
            if (isset($data['image'])) {
                $this->deleteFile($data['image'], 'listings');
            }

            if (isset($data['thumbnail_image'])) {
                $this->deleteFile($data['thumbnail_image'], 'listings');
            }

            if (isset($data['attachments'])) {
                $this->deleteFile($data['attachments'], 'listings');
            }

            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $user = auth()->user();
        $this->authorize('view', $listing);
        return view('frontend.dashboard.listings.show', [
            'listing' => $listing,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
//        $listing = Listing::findOrFail($id);

        $this->authorize('update', $listing);
//        if (Auth::id() !== $listing->user_id) {
//
//            abort(403, 'Unauthorized action.');
//
//        }


        $user = auth()->user();
        $selectedAmenities = $listing->amenities()->pluck('amenities.id')->toArray();
        $categories = Category::active()->get();
        $locations = Location::active()->get();
        $amenities = Amenity::active()->get();
        return view('frontend.dashboard.listings.edit', [
            'listing' => $listing,
            'user' => $user,
            'locations' => $locations,
            'categories' => $categories,
            'amenities' => $amenities,
            'selectedAmenities' => $selectedAmenities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgentListingRequest $request, Listing $listing)
    {
        $this->authorize('update', $listing);
        DB::beginTransaction();
        try {
//            $listing = Listing::findOrFail($id);
            $old_image = $listing->image;
            $old_thumbnail_image = $listing->thumbnail_image;
            $old_attachments = $listing->attachments;

            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);
            $data['image'] = $this->uploadFile($request, 'image', $old_image, 'listings');
            $data['thumbnail_image'] = $this->uploadFile($request, 'thumbnail_image', $old_thumbnail_image, 'listings');
            $data['attachments'] = $this->uploadFile($request, 'attachments', $old_attachments, 'listings');
//            $data['user_id'] = Auth::id();

            $listing->amenities()->sync($data['amenities']);
            $listing->update($data);
            DB::commit();
            return to_route('user.listings.index')
                ->with('success', 'Listing updated successfully.');

        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
//        $listing = Listing::findOrFail($id);
        $listing->delete();
//        $this->deleteFile($listing->image, 'user_listings');
//        $this->deleteFile($listing->thumbnail_image, 'user_listings');
//        $this->deleteFile($listing->attachments, 'user_listings');
        return to_route('user.listings.index')
            ->with('success', 'Listing deleted successfully.');
    }
}
