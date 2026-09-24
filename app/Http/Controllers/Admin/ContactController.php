<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index(Request $request): View
    {
        $query = Contact::query();

        // Filter by status (read / unread)
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->unread();
            } elseif ($request->status === 'read') {
                $query->read();
            }
        }

        // Search in name, email, phone, or message
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total'  => Contact::count(),
            'unread' => Contact::unread()->count(),
            'read'   => Contact::read()->count(),
            'today'  => Contact::whereDate('created_at', today())->count(),
        ];

        return view('admin.contact.index', compact('contacts', 'stats'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(Contact $contact): View
    {
        // Automatically mark as read if it is unread
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Toggle read/unread status of the contact message.
     */
    public function toggleRead(Contact $contact): RedirectResponse
    {
        $contact->update([
            'is_read' => !$contact->is_read,
        ]);

        $statusMessage = $contact->is_read
            ? 'Message marked as read.'
            : 'Message marked as unread.';

        return back()->with('success', $statusMessage);
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }
}
