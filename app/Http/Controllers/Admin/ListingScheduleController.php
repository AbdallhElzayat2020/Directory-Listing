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
use Illuminate\Database\QueryException;
use Exception;

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
                ->route('admin.listings.schedules.index', $listing->id)
                ->with('success', 'Schedule added successfully.');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(Listing $listing, ListingSchedule $schedule)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin.listings.listing-schedule.edit', compact('listing', 'schedule', 'days'));
    }

    public function update(UpdateListingScheduleRequest $request, Listing $listing, ListingSchedule $schedule)
    {
        try {
            $data = $request->validated();

            // التحقق الإضافي قبل التحديث
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
                ->route('admin.listings.schedules.index', $listing->id)
                ->with('success', 'Schedule updated successfully.');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy(Listing $listing, ListingSchedule $schedule)
    {
        try {
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

        } catch (Exception $e) {
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
