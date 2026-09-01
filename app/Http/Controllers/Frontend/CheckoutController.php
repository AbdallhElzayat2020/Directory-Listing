<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(string $slug, string $id)
    {
        $package = Package::where('slug', $slug)->where('id', $id)->firstOrFail();

        /* store package id in session */
//        Session::put('selected_package_id', $package->id);
        session()->put('selected_package_id', $package->id);

        return view('frontend.pages.checkout', compact('package'));
    }
}
