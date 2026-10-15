<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionsSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            HeroSeeder::class,
            CategorySeeder::class,
            AmenitySeeder::class,
            LocationSeeder::class,
            SettingSeeder::class,
            PaymentSettingSeeder::class,
        ]);
    }
}
