<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->render('frontend.dashboard.order.index', compact('user'));
    }

    public function show($id)
    {

        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $this->authorize('view', $order);

        $user = Auth::user();

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('frontend.dashboard.order.show', compact('order', 'user'));
    }
}
