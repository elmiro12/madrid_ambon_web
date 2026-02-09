<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SocialMedia::create([
            'name' => 'Facebook',
            'url' => 'https://facebook.com/prmiambon',
            'icon' => 'fa-brands fa-facebook-f', // Contoh icon, bisa disesuaikan
            'is_active' => true
        ]);

        SocialMedia::create([
            'name' => 'Instagram',
            'url' => 'https://instagram.com/prmiambon',
            'icon' => 'fa-brands fa-instagram', // Contoh icon, bisa disesuaikan
            'is_active' => true
        ]);
        SocialMedia::create([
            'name' => 'Twitter',
            'url' => 'https://twitter.com/prmiambon',
            'icon' => 'fa-brands fa-twitter', // Contoh icon, bisa disesuaikan
            'is_active' => false
        ]);
        SocialMedia::create([
            'name' => 'YouTube',
            'url' => 'https://youtube.com/prmiambon',
            'icon' => 'fa-brands fa-youtube', // Contoh icon, bisa disesuaikan
            'is_active' => false
        ]);
        SocialMedia::create([
            'name' => 'TikTok',
            'url' => 'https://tiktok.com/@prmiambon',
            'icon' => 'fa-brands fa-tiktok', // Contoh icon, bisa disesuaikan
            'is_active' => true
        ]);
        // Tambahkan social media lainnya
}

}
