<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::active()->where('user_type', 'user')
            ->count();
        $totalAdmins = User::active()->where('user_type', 'admin')
            ->count();

        $totalListings = User::active()
            ->withCount('listings')
            ->get()
            ->sum('listings_count');

        $pendingListings = Listing::active()->where('is_approved', 'no')->count();

        $totalCategories = Category::whereStatus('active')->count();
        $totalLocations = Location::active()->count();
        $totalAmenities = Amenity::active()->count();
        $totalUnReadMessages = Contact::where('is_read', false)->count();

        $totalActivePackages = Package::active()->count();
        $totalUnActivePackages = Package::inactive()->count();
        $totalOrders = Order::all()->count();

        return view('admin.dashboard.index', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalListings' => $totalListings,
            'pendingListings' => $pendingListings,
            'totalCategories' => $totalCategories,
            'totalLocations' => $totalLocations,
            'totalAmenities' => $totalAmenities,
            'totalUnReadMessages' => $totalUnReadMessages,
            'totalUnActivePackages' => $totalUnActivePackages,
            'totalActivePackages' => $totalActivePackages,
            'totalOrders' => $totalOrders,
        ]);
    }
}
