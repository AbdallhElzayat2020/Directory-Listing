<?php

namespace App\Providers;

use App\Services\PaymentSettingService;
use Illuminate\Support\ServiceProvider;

class PaymentSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentSettingService::class);
    }

    public function boot(): void
    {
        $paymentSettingService = $this->app->make(PaymentSettingService::class);

        $paymentSettingService->setGlobalSettings();
    }
}
