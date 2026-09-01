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
}
