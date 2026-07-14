<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LocationsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Location\CreateLocationRequest;
use App\Http\Requests\Admin\Location\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LocationsDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLocationRequest $request)
    {
        Location::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
            'show_at_home' => $request->show_at_home,
            'notes' => $request->notes,
        ]);

        return to_route('admin.locations.index')
            ->with('success', 'created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::findOrFail($id);
        return view('admin.locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = Location::findOrFail($id);
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, string $id)
    {
        $location = Location::findOrFail($id);
        $location->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'status' => $request->status,
            'show_at_home' => $request->show_at_home,
            'notes' => $request->notes,
        ]);
        return to_route('admin.locations.index')
            ->with('success', 'updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return to_route('admin.locations.index')
            ->with('success', 'deleted successfully.');
    }
}
