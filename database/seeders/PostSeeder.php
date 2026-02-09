<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Post::create([
            'title' => 'Event Fun Futsal',
            'content' => 'Detail tentang acara futsal...',
            'slug' => 'fun-futsal',
            'summary' => 'Fun Futsal',
            'is_published' => true,
            'published_at' => now(),
            'category_id' => 2
        ]);

        Post::create([
            'title' => 'Kopdar PRMI',
            'content' => 'Detail tentang kopdar...',
            'slug' => 'kopdar',
            'summary' => 'kopdar',
            'is_published' => true,
            'published_at' => now(),
            'category_id' => 2
        ]);

        // Tambahkan post lainnya
}

}
