<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            'title' => 'Let us help you Find Buy & Own Dreams Home',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos quasi facilis, cupiditate rem voluptates omnis repellat consectetur nihil quod a, illo nemo eveniet iste, minima delectus doloribus! Praesentium, maiores iusto?',
            'bg_image' => 'hero-bg.jpg',
        ]);
    }
}
