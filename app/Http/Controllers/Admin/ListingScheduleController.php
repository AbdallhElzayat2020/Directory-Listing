<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ListingScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\StoreListingScheduleRequest;
use App\Http\Requests\Admin\Schedule\UpdateListingScheduleRequest;
use App\Models\Listing;
use App\Models\ListingSchedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListingScheduleController extends Controller
{
    public function index(ListingScheduleDataTable $dataTable, Listing $listing)
    {
        return $dataTable->render('admin.listings.listing-schedule.index', compact('listing'));
    }

    public function create(Listing $listing)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin.listings.listing-schedule.create', compact('listing', 'days'));
    }

    public function store(StoreListingScheduleRequest $request, Listing $listing)
    {
        $exists = ListingSchedule::where('listing_id', $listing->id)
            ->where('day', $request->day)
            ->where('status', 'active')
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An active schedule already exists for ' . $request->day . '. Please deactivate the existing schedule first.');
        }

        $listing->schedules()->create($request->validated());

        return redirect()
            ->route('admin.listings.schedules.index', $listing->id)
            ->with('success', 'Schedule added successfully.');
    }

    public function edit(Listing $listing, ListingSchedule $schedule)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin.listings.listing-schedule.edit', compact('listing', 'schedule', 'days'));
    }

    public function update(UpdateListingScheduleRequest $request, Listing $listing, ListingSchedule $schedule)
    {
        if ($request->status == 'active') {
            $exists = ListingSchedule::where('listing_id', $listing->id)
                ->where('day', $request->day)
                ->where('status', 'active')
                ->where('id', '!=', $schedule->id)
                ->exists();

            if ($exists) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'An active schedule already exists for ' . $request->day . '. Please deactivate the existing schedule first.');
            }
        }

        $schedule->update($request->validated());

        return redirect()
            ->route('admin.listings.schedules.index', $listing->id)
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Listing $listing, ListingSchedule $schedule)
    {
        $schedule->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Schedule deleted successfully.'
            ]);
        }

        return redirect()
            ->route('admin.listings.schedules.index', $listing->id)
            ->with('success', 'Schedule deleted successfully.');
    }
}
