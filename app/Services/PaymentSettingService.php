<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{

    function getSettings()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('settings', $settings); // config('settings.site_name');
    }

    function clearCachedSettings()
    {
        Cache::forget('settings');
    }
}
