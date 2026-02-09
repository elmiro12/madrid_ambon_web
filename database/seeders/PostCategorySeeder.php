<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create([
            'name' => 'Komunitas',
            'slug' => 'komunitas',
            'icon' => 'fa-shield-heart',
            'hits' => 0,
        ]);
        PostCategory::create([
            'name' => 'Event',
            'slug' => 'event',
            'icon' => 'fa-calendar-days',
            'hits' => 0,
        ]);
        PostCategory::create([
            'name' => 'Real Madrid',
            'slug' => 'real-madrid',
            'icon' => 'fa-football',
            'hits' => 0,
        ]);
        PostCategory::create([
            'name' => 'La Liga',
            'slug' => 'la-liga',
            'icon' => 'fa-trophy',
            'hits' => 0,
        ]);
    }
}
