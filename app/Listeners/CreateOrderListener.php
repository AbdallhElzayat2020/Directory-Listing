<?php

namespace App\Listeners;

use App\Events\CreateOrder;
use App\Models\Order;
use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CreateOrderListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateOrder $event): void
    {
        $package = Package::find(Session::get('selected_package_id'));

        try {
            DB::beginTransaction();
            $order = Order::create([
                'order_id' => uniqid(),
                'transaction_id' => $event->paymentInfo['transaction_id'],
                'user_id' => auth()->user()->id,
                'package_id' => $package->id,
                'payment_method' => $event->paymentInfo['payment_method'],
                'payment_status' => $event->paymentInfo['payment_status'],
                'base_amount' => $package->price,
                'base_currency' => config('settings.site_default_currency'),
                'paid_amount' => $event->paymentInfo['paid_amount'],
                'paid_currency' => $event->paymentInfo['paid_currency'],
                'purchase_date' => now(),
            ]);

            Subscription::updateOrCreate(
                ['user_id' => auth()->user()->id],
                [
                    'package_id' => $package->id,
                    'order_id' => $order->id,
                    'purchase_date' => $order->purchase_date,
                    'expire_date' => $package->number_of_days == -1
                        ? null
                        : Carbon::parse($order->purchase_date)->addDays($package->number_of_days),
                    'status' => 'active',
                ]
            );

            Session::forget('selected_package_id');

            DB::commit();
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error or display a message to the user
            \Log::error('Error creating order: ' . $e->getMessage());
            DB::rollBack();
            return;
        }
    }
}
