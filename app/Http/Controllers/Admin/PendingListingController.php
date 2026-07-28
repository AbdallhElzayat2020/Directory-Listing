<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PendingListingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PendingListingController extends Controller
{
    public function index(PendingListingDataTable $dataTable)
    {
        return $dataTable->render('admin.pending-listing.index');
    }

    /**
     * Update Pending the specified resource from storage.
     */
    public function updateStatus(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:listings,id',
            'value' => 'required|in:yes,no'
        ]);
        try {

            $listing = Listing::findOrFail($request->id);
            $listing->update([
                'is_approved' => $request->value,
            ]);

            return response([
                'status' => 'success',
                'message' => 'status updated successfully.'
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
