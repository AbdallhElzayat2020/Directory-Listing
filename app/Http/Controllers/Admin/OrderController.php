<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:order index'])->only(['index', 'show', 'update']);
        $this->middleware(['permission:order delete'])->only('destroy');
    }

    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user', 'package'])->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'payment_status' => ['required', 'in:pending,completed,failed']
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'payment_status' => $request->payment_status
        ]);

        return redirect()->back()->with('success', 'Order payment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->subscription()->delete();
        $order->delete();

        return to_route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit(Order $order)
    {

    }

}
