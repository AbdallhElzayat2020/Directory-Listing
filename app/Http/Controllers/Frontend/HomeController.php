<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hero;
use App\Models\Listing;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banner = Hero::first();
        $categories = Category::active()->showAtHome()->limit(10)->get();
        $packages = Package::with('features')->active()->showAtHome()->limit(3)->get();
        return view('frontend.home.index', [
            'banner' => $banner,
            'categories' => $categories,
            'packages' => $packages,
        ]);
    }


}
