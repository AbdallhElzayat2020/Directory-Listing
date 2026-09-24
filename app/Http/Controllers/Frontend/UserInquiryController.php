<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInquiryController extends Controller
{
    //
    public function index()
    {
        $inquiries = Inquiry::where('owner_id', Auth::id())
            ->with(['listing', 'sender'])
            ->latest()
            ->paginate(15);

        $user = Auth::user();
        $stats = [
            'total'  => Inquiry::where('owner_id', Auth::id())->count(),
            'unread' => Inquiry::where('owner_id', Auth::id())->where('is_read', false)->count(),
            'read'   => Inquiry::where('owner_id', Auth::id())->where('is_read', true)->count(),
        ];

        return view('frontend.dashboard.inquiries.index', compact('inquiries', 'stats', 'user'));
    }

    public function show(Inquiry $inquiry)
    {
        $user = Auth::user();
        abort_unless($inquiry->owner_id === Auth::id(), 403);

        if (!$inquiry->is_read) {
            $inquiry->update(['is_read' => true]);
        }

        $inquiry->load(['listing', 'sender']);

        return view('frontend.dashboard.inquiries.show', compact('inquiry', 'user'));
    }

    public function destroy(Inquiry $inquiry)
    {
        abort_unless($inquiry->owner_id === Auth::id(), 403);

        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted successfully.');
    }
}
