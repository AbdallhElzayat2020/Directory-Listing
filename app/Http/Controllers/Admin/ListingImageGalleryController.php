<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingImageGallery;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ListingImageGalleryController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index(Listing $listing): View
    {
        $images = $listing->images;
        return view('admin.listings.imageGallery.index', compact('listing', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048']
        ], [

            'images.*.image' => 'One or more images are not valid. Please upload valid image files (jpeg, png, jpg, webp) with a maximum size of 2MB.',
            'images.*.mimes' => 'One or more images are not valid. Please upload valid image files (jpeg, png, jpg, webp) with a maximum size of 2MB.',
            'images.*.max' => 'One or more images exceed the maximum size of 2MB.'

        ]);
        $imagesPath = $this->uploadFiles($request, 'images', [], 'listing_images');

        foreach ($imagesPath as $imagePath) {

            $listing->images()->create([
                'image' => $imagePath
            ]);
        }


        return redirect()->back()->with('success', 'Images uploaded successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing, ListingImageGallery $image)
    {
        try {

            $this->deleteFile($image->image, 'listing_images');

            $image->delete();

        } catch (\Exception $exception) {

            return back()->with('error', 'listing_images_delete' . $exception->getMessage());
        }


        return back()->with('success', 'Image deleted successfully.');
    }
}
