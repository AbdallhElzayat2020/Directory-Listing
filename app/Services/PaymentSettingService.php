<?php

namespace App\Services;

use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Cache;

class PaymentSettingService
{

    function getSettings()
    {
        return Cache::rememberForever('payment', function () {
            return PaymentSetting::pluck('value', 'key')->toArray();  // payment.paypal_status from any file from config->  config('payment.paypal_status')
        });
    }

    function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('payment', $settings); // config('settings.site_name');
    }

    function clearCachedSettings()
    {
        Cache::forget('payment');
    }
}
