<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banner = Hero::first();
        $categories = Category::active()->showAtHome()->latest()->limit(8)->get();
        return view('frontend.home.index', [
            'banner' => $banner,
            'categories' => $categories
        ]);
    }
}
