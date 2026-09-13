<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $subscription = Subscription::where('user_id', $user->id)
            ->first();

        return view('frontend.dashboard.home', [
            'user' => $user,
            'subscription' => $subscription,
        ]);
    }
}
