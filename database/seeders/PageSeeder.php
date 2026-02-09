<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Page::create([
            'title' => 'About Us',
            'content' => 'Tentang PRMI Regional Ambon...',
            'slug' => 'about-us',
            'menu_id' => 1,
            'icon' => 'fa-circle-info'
        ]);

        Page::create([
            'title' => 'Komunitas',
            'content' => 'Komunitas PRMI...',
            'slug' => 'komunitas',
            'icon' => 'fa-futbol',
            'menu_id' => 1,
        ]);

        // Tambahkan halaman lainnya
    }

}
