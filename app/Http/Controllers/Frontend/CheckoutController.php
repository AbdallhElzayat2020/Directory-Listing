<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CreateOrder;
use App\Http\Controllers\Controller;
use App\Models\Package;

class CheckoutController extends Controller
{
    public function index(string $slug, string $id)
    {
        $package = Package::where('slug', $slug)->where('id', $id)->firstOrFail();
        /* store package id in session */
        session()->put('selected_package_id', $package->id);


        // check if package free to create order without payment
        if ($package->package_type === 'free' || $package->price == 0) {

            // create Order with event dispatch
            $paymentInfo = [
                'transaction_id' => uniqid(),
                'payment_method' => 'Free',
                'paid_amount' => 0,
                'paid_currency' => config('settings.site_default_currency'),
                'payment_status' => 'completed',
            ];

            CreateOrder::dispatch($paymentInfo);
            return redirect()->route('user.dashboard')
                ->with('success', __('Your order has been placed successfully.'));
        }

        return view('frontend.pages.checkout', compact('package'));
    }
}
