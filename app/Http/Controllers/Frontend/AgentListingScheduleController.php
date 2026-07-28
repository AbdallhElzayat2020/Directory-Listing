<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\AgentListingDataTable;
use App\DataTables\AgentListingScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\StoreListingScheduleRequest;
use App\Http\Requests\Admin\Schedule\UpdateListingScheduleRequest;
use App\Models\Listing;
use App\Models\ListingSchedule;

class AgentListingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AgentListingScheduleDataTable $dataTable, Listing $listing)
    {
        $user = auth()->user();

        if ($listing->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

//        $this->authorize('view', $listing);

        return $dataTable->render('frontend.dashboard.listings.listing-schedule.index', compact('listing', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Listing $listing)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $user = auth()->user();
        return view('frontend.dashboard.listings.listing-schedule.create', compact('listing', 'user', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingScheduleRequest $request, Listing $listing)
    {
        try {
            $data = $request->validated();

            $exists = ListingSchedule::hasActiveSchedule($listing->id, $data['day']);

            if ($exists) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'An active schedule already exists for ' . $data['day'] . '. Please deactivate the existing schedule first.');
            }

            $listing->schedules()->create($data);

            return redirect()
                ->route('user.listings.schedules.index', $listing->id)
                ->with('success', 'Schedule added successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing, ListingSchedule $schedule)
    {
        $user = auth()->user();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        if ($listing->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
//        $this->authorize('update', $listing);

        return view('frontend.dashboard.listings.listing-schedule.edit', compact('listing', 'user', 'schedule', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingScheduleRequest $request, Listing $listing, ListingSchedule $schedule)
    {
        if ($listing->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $data = $request->validated();

            // التقق الإضافي قبل التحديث
            if ($data['status'] === 'active') {
                $exists = ListingSchedule::hasActiveSchedule($listing->id, $data['day'], $schedule->id);

                if ($exists) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'An active schedule already exists for ' . $data['day'] . '. Please deactivate the existing schedule first.');
                }
            }

            $schedule->update($data);

            return redirect()
                ->route('user.listings.schedules.index', $listing->id)
                ->with('success', 'Schedule updated successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing, ListingSchedule $schedule)
    {
        if ($listing->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $schedule->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Schedule deleted successfully.'
                ]);
            }

            return redirect()
                ->route('user.listings.schedules.index', $listing->id)
                ->with('success', 'Schedule deleted successfully.');

        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }

            return redirect()
                ->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
