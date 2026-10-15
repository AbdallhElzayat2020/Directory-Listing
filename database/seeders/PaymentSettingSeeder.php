<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSettingSeeder extends Seeder
{
    public function run(): void
    {
        $payment_settings = array(
            array('id' => '1', 'key' => 'paypal_status', 'value' => 'active', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 03:20:13'),
            array('id' => '2', 'key' => 'paypal_mode', 'value' => 'sandbox', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 03:20:13'),
            array('id' => '3', 'key' => 'paypal_country', 'value' => 'US', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 09:29:24'),
            array('id' => '4', 'key' => 'paypal_currency', 'value' => 'USD', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-07 12:52:43'),
            array('id' => '5', 'key' => 'paypal_currency_rate', 'value' => '1', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 10:39:03'),
            array('id' => '6', 'key' => 'paypal_client_id', 'value' => '', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 09:29:24'),
            array('id' => '7', 'key' => 'paypal_secret_key', 'value' => '', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 09:29:24'),
            array('id' => '8', 'key' => 'paypal_app_key', 'value' => 'booking', 'created_at' => '2026-08-07 03:23:40', 'updated_at' => '2026-08-10 09:29:24'),
            array('id' => '9', 'key' => 'stripe_status', 'value' => 'active', 'created_at' => '2026-09-02 08:49:05', 'updated_at' => '2026-09-02 08:49:05'),
            array('id' => '10', 'key' => 'stripe_country', 'value' => 'US', 'created_at' => '2026-09-02 08:49:05', 'updated_at' => '2026-09-02 08:49:05'),
            array('id' => '11', 'key' => 'stripe_currency', 'value' => 'USD', 'created_at' => '2026-09-02 08:49:05', 'updated_at' => '2026-09-02 08:49:05'),
            array('id' => '12', 'key' => 'stripe_currency_rate', 'value' => '1', 'created_at' => '2026-09-02 08:49:05', 'updated_at' => '2026-09-02 08:49:05'),
            array('id' => '13', 'key' => 'stripe_key', 'value' => '', 'created_at' => '2026-09-02 08:49:05', 'updated_at' => '2026-09-02 08:49:05'),
            array('id' => '14', 'key' => 'stripe_secret_key', 'value' => '', 'created_at' => '2026-09-02 08:49:05', 'updated_at' => '2026-09-02 08:49:05')
        );

        if (DB::table('payment_settings')->count() > 0) {
            DB::table('payment_settings')->truncate();
        }

        DB::table('payment_settings')->insert($payment_settings);
    }
}
