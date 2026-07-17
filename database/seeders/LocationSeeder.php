<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::updateOrCreate([
            'slug' => 'sample-location'
        ],
            [
                'title' => 'sample location',
                'status' => 'active',
                'notes' => 'This is a sample location.',
            ]
        );
    }
}
