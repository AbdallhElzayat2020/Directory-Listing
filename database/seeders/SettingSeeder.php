<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = array(
            array('id' => '1', 'key' => 'site_name', 'value' => 'ListingApp', 'created_at' => '2026-08-05 03:10:37', 'updated_at' => '2026-08-05 03:21:18'),
            array('id' => '2', 'key' => 'site_email', 'value' => 'abdallhelzayat194@gmail.com', 'created_at' => '2026-08-05 03:10:37', 'updated_at' => '2026-08-05 03:10:37'),
            array('id' => '3', 'key' => 'site_phone', 'value' => '01019386883', 'created_at' => '2026-08-05 03:10:37', 'updated_at' => '2026-08-05 03:10:37'),
            array('id' => '4', 'key' => 'site_default_currency', 'value' => 'USD', 'created_at' => '2026-08-05 03:10:37', 'updated_at' => '2026-08-05 03:10:37'),
            array('id' => '5', 'key' => 'site_currency_icon', 'value' => '$', 'created_at' => '2026-08-05 03:10:37', 'updated_at' => '2026-08-05 03:28:00'),
            array('id' => '6', 'key' => 'site_currency_position', 'value' => 'left', 'created_at' => '2026-08-05 03:10:37', 'updated_at' => '2026-08-05 03:28:00'),
            array('id' => '7', 'key' => 'logo', 'value' => '23b9bb30-a48b-4baf-a224-a86830ac7637.jpg', 'created_at' => '2026-10-13 17:43:30', 'updated_at' => '2026-10-15 07:14:17'),
            array('id' => '8', 'key' => 'favicon', 'value' => 'c5f86d38-687c-4438-be3f-4c16ae55ba28.png', 'created_at' => '2026-10-13 17:43:30', 'updated_at' => '2026-10-15 07:14:17'),
            array('id' => '9', 'key' => 'site_color', 'value' => '#a85e0b', 'created_at' => '2026-10-13 18:44:25', 'updated_at' => '2026-10-15 07:13:48')
        );
        if (DB::table('settings')->count() > 0) {
            DB::table('settings')->truncate();
        }
        DB::table('settings')->insert($settings);

    }
}
