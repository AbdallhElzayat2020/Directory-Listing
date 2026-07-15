<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Amenity\CreateAmenityRequest;
use App\Http\Requests\Admin\Amenity\UpdateAmenityRequest;
use App\Models\Amenity;
use App\Traits\FileHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AmenityController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(AmenityDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.amenity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.amenity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAmenityRequest $request)
    {
        Amenity::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
            'icon' => $request->icon,
        ]);

        return to_route('admin.amenities.index')
            ->with('success', 'created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('admin.amenity.show', compact('amenity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('admin.amenity.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request, string $id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
//            'icon' => $request->icon ?: $amenity->icon,
            'icon' => $request->icon ?? $amenity->icon,
//            'icon' => $request->filled('icon') ? $request->icon : $amenity->icon,
            'status' => $request->status,
        ]);

        return to_route('admin.amenities.index')
            ->with('success', 'updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();

        return to_route('admin.amenities.index')
            ->with('success', 'deleted successfully.');
    }
}
