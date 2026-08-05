<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;

class CheckoutController extends Controller
{
    public function index(string $slug, string $id)
    {
        $package = Package::where('slug', $slug)->where('id', $id)->firstOrFail();
        return view('frontend.pages.checkout', compact('package'));
    }
}
