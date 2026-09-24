<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::with(['listing', 'owner', 'sender']);

        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        if ($request->filled('listing_id')) {
            $query->where('listing_id', $request->listing_id);
        }

        // بحث
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total'  => Inquiry::count(),
            'unread' => Inquiry::where('is_read', false)->count(),
            'read'   => Inquiry::where('is_read', true)->count(),
            'today'  => Inquiry::whereDate('created_at', today())->count(),
        ];

        $listings = Listing::select('id', 'title')->orderBy('title')->get();

        return view('admin.inquiries.index', compact('inquiries', 'stats', 'listings'));
    }

    public function show(Inquiry $inquiry)
    {
        if (!$inquiry->is_read) {
            $inquiry->update(['is_read' => true]);
        }

        $inquiry->load(['listing', 'owner', 'sender']);

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted successfully.');
    }
}
