<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePaymentSettingRequest;
use App\Models\PaymentSetting;
use App\Models\Setting;
use App\Services\PaymentSettingService;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        return view('admin.payment-setting.index');
    }

    public function paypalSetting(UpdatePaymentSettingRequest $request, PaymentSettingService $paymentSettingService)
    {

        foreach ($request->validated() as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $paymentSettingService->clearCachedSettings();

        return redirect()->back()->with('success', 'updated successfully.');
    }

    public function stripeSetting(Request $request, PaymentSettingService $paymentSettingService)
    {
        $validatedData = $request->validate([
            'stripe_status' => ['required', 'in:active,inactive'],
            'stripe_country' => ['required'],
            'stripe_currency' => ['required'],
            'stripe_currency_rate' => ['required'],
            'stripe_key' => ['required'],
            'stripe_secret_key' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $paymentSettingService->clearCachedSettings();

        return redirect()->back()->with('success', 'updated successfully.');
    }
}
