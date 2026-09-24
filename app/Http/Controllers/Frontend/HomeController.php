<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hero;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
//        $banner = Hero::first() ?? new Hero();
//
//        $categories = Category::active()->showAtHome()->limit(10)->get();
//
//        $packages = Package::with('features')->active()->showAtHome()->limit(3)->get();
//
//        $featuredCategories = Category::withCount(['listings' => fn($q) => $q->active()])
//            ->has('listings')
//            ->active()
//            ->showAtHome()
//            ->limit(6)
//            ->get();
//
//        $featuredLocation = Location::whereHas('listings', fn($q) => $q->showAtHome()->active())
//            ->with(['listings' => fn($q) => $q->showAtHome()->active()->with('category')->orderByDesc('id')])
//            ->active()
//            ->showAtHome()
//            ->get();
//
//        $featuredListings = Listing::showAtHome()
//            ->with(['category', 'location'])
//            ->orderByDesc('id')
//            ->limit(10)
//            ->get();



        $banner = Hero::first();

        $categories = Category::active()->showAtHome()->limit(10)->get();

        $packages = Package::with('features')->active()->showAtHome()->limit(3)->get();

        $featuredCategories = Category::withCount(['listings' => function ($query) {
            $query->active();

        }])->active()
            ->showAtHome()
            ->limit(6)
            ->get();

        $featuredLocation = Location::whereHas('listings', function ($query) {
            $query->where([
                'status'      => 'active',
                'is_approved' => 'yes',
                'is_verified' => 'yes',
                'is_featured' => 'yes'
            ]);
        })
            ->with(['listings' => function ($query) {
                $query->where([
                    'status'      => 'active',
                    'is_approved' => 'yes',
                    'is_verified' => 'yes',
                    'is_featured' => 'yes'])
                    ->with('category')
                    ->orderByDesc('id');
            }])
            ->active()
            ->showAtHome()
            ->get();

        $featuredListings = Listing::where([
            'status'      => 'active',
            'is_featured' => 'yes',
            'is_approved' => 'yes',
            'is_verified' => 'yes'
        ])->with(['category','location'])
            ->limit(8)
            ->latest()
            ->get();


        return view('frontend.home.index', [
            'banner'             => $banner,
            'categories'         => $categories,
            'packages'           => $packages,
            'featuredCategories' => $featuredCategories,
            'featuredListings'   => $featuredListings,
            'featuredLocation'   => $featuredLocation
        ]);
    }


}
