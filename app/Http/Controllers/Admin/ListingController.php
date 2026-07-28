<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ListingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Listing\CreateListingRequest;
use App\Http\Requests\Admin\Listing\UpdateListingRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Location;
use App\Traits\FileHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ListingController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(ListingDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.listings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::active()->get();
        $locations = Location::active()->get();
        $amenities = Amenity::active()->get();

        return view('admin.listings.create', [
            'locations' => $locations,
            'categories' => $categories,
            'amenities' => $amenities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(CreateListingRequest $request)
    {

        $image = null;
        $thumbnail = null;
        $attachments = null;
//        try {
//            $data = $request->validated();
//            $data['user_id'] = Auth::id();
//            $data['slug'] = Str::slug($data['title']);
//            $data['image'] = $this->uploadFile($request, 'image', $image, 'listings');
//            $data['thumbnail_image'] = $this->uploadFile($request, 'thumbnail_image', $thumbnail, 'listings');
//            $data['attachments'] = $this->uploadFile($request, 'attachments', $attachments, 'listings');
//
//            DB::transaction(function () use ($data) {
//
//                $listing = Listing::create($data);
//                $listing->amenities()->attach($data['amenities']);
//
//            });
//
//        } catch (\Exception $exception) {
//
//            if (isset($data['image'])) {
//                $this->deleteFile($data['image'], 'listings');
//            }
//
//            if (isset($data['thumbnail_image'])) {
//                $this->deleteFile($data['thumbnail_image'], 'listings');
//            }
//
//            if (isset($data['attachments'])) {
//                $this->deleteFile($data['attachments'], 'listings');
//            }
//            return back()->with('error', $exception->getMessage());
//        }


        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $data['slug'] = Str::slug($request->title);
            $data['is_approved'] = 'yes';
            $data['image'] = $this->uploadFile($request, 'image', $image, 'listings');
            $data['thumbnail_image'] = $this->uploadFile($request, 'thumbnail_image', $thumbnail, 'listings');
            $data['attachments'] = $this->uploadFile($request, 'attachments', $attachments, 'listings');

            $listing = Listing::create($data);

            $listing->amenities()->attach($data['amenities']);
            DB::commit();
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


        return to_route('admin.listings.index')
            ->with('success', 'Listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $listing = Listing::findOrFail($id);
        return view('admin.listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::findOrFail($id);
//        $selectedAmenities = ListingAmenity::where('listing_id', $listing->id)->pluck('amenity_id')->toArray();
//        dd($selectedAmenities);
        $selectedAmenities = $listing->amenities()->pluck('amenities.id')->toArray();
        $categories = Category::active()->get();
        $locations = Location::active()->get();
        $amenities = Amenity::active()->get();
        return view('admin.listings.edit', [
            'listing' => $listing,
            'locations' => $locations,
            'categories' => $categories,
            'amenities' => $amenities,
            'selectedAmenities' => $selectedAmenities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, string $id)
    {
//        try {
//            $listing = Listing::findOrFail($id);
//            $old_image = $listing->image;
//            $old_thumbnail_image = $listing->thumbnail_image;
//            $old_attachments = $listing->attachments;
//
//            $data = $request->validated();
//            $data['slug'] = Str::slug($data['title']);
//            $data['image'] = $this->uploadFile($request, 'image', $old_image, 'listings');
//            $data['thumbnail_image'] = $this->uploadFile($request, 'thumbnail_image', $old_thumbnail_image, 'listings');
//            $data['attachments'] = $this->uploadFile($request, 'attachments', $old_attachments, 'listings');
//            $data['user_id'] = Auth::id();
//
//            DB::transaction(function () use ($data, $listing) {
//
//                $listing->amenities()->sync($data['amenities']);
//                $listing->update($data);
//            });
//            return redirect()->back()->with('success', 'Listing updated successfully.');
//        } catch (\Exception $exception) {
//            return back()->with('error', $exception->getMessage());
//        }

        DB::beginTransaction();
        try {
            $listing = Listing::findOrFail($id);
            $old_image = $listing->image;
            $old_thumbnail_image = $listing->thumbnail_image;
            $old_attachments = $listing->attachments;

            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);
            $data['image'] = $this->uploadFile($request, 'image', $old_image, 'listings');
            $data['thumbnail_image'] = $this->uploadFile($request, 'thumbnail_image', $old_thumbnail_image, 'listings');
            $data['attachments'] = $this->uploadFile($request, 'attachments', $old_attachments, 'listings');
            $data['user_id'] = Auth::id();

            $listing->amenities()->sync($data['amenities']);
            $listing->update($data);
            DB::commit();
            return to_route('admin.listings.index')
                ->with('success', 'Listing updated successfully.');

        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listing = Listing::findOrFail($id);

        $listing->delete();
        return to_route('admin.listings.index')
            ->with('success', 'Listing deleted successfully.');


    }


}
