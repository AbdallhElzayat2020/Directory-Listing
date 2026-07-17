<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate([
            'slug' => 'sample-category'
        ],
            [
                'title' => 'sample category',
                'description' => 'This is a sample category.',
                'icon_image' => 'test.png',
                'bg_image' => 'test.png',
                'status' => 'active',
            ]
        );
    }
}
