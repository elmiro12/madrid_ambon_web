<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'name' => 'Profil',
            'slug' => 'profil',
            'icon' => 'fa-brands fa-web-awesome',
            'is_active' => true,
            'order' => 1,
        ]);
        Menu::create([
            'name' => 'Event',
            'slug' => 'event',
            'icon' => 'fa-calendar-days',
            'is_active' => true,
            'order' => 3,
        ]);
        Menu::create([
            'name' => 'Galeri/Video',
            'slug' => 'galeri',
            'icon' => 'fa-photo-film',
            'is_active' => true,
            'order' => 4,
        ]);
        Menu::create([
            'name' => 'Berita',
            'slug' => 'berita',
            'icon' => 'fa-newspaper',
            'is_active' => true,
            'order' => 5,
        ]);
        Menu::create([
            'name' => 'Kontak',
            'slug' => 'kontak',
            'icon' => 'fa-envelope',
            'is_active' => true,
            'order' => 7,
        ]);
        Menu::create([
            'name' => 'Social Media',
            'slug' => 'social-media',
            'icon' => 'fa-share-alt',
            'is_active' => true,
            'order' => 6,
        ]);
    }
}
