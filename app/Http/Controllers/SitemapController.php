<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        // Membuat sitemap baru
        $sitemap = Sitemap::create();

        // Menambahkan URL untuk halaman Beranda (Home)
        $sitemap->add(
            Url::create(route('home')) // URL untuk halaman beranda
                ->setPriority(1.0) // Prioritas tertinggi untuk beranda
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY) // Halaman beranda sering diperbarui
        );
        

        // Menambahkan URL untuk halaman statis (Page)
        $pages = Page::all();
        foreach ($pages as $page) {
            $sitemap->add(
                Url::create(route('pages', ['slug' => $page->slug])) // URL untuk halaman statis
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );
        }
        
        //halaman event
        $sitemap->add(
                Url::create(route('pages', ['slug' => 'event'])) // URL untuk halaman statis
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );

        // Menambahkan URL untuk halaman berita (Post)
        $posts = Post::all();
        foreach ($posts as $post) {
            $sitemap->add(
                Url::create(route('berita.show', ['slug' => $post->slug])) // URL untuk halaman berita
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }
        
        $categories = PostCategory::all();
        
        foreach($categories as $category){
            $sitemap->add(
                Url::create(route('berita.category', ['slug' => $category->slug])) // URL untuk halaman berita
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }

        // Menambahkan URL untuk galeri
        $albums = GalleryAlbum::all();
        
        // Menambahkan URL untuk halaman gallery gambar
        $sitemap->add(
            Url::create(route('pages',['slug' => 'gambar'])) // URL untuk halaman beranda
                ->setPriority(1.0) // Prioritas tertinggi untuk beranda
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY) // Halaman beranda sering diperbarui
        );
         // Menambahkan URL untuk halaman gallery video
        $sitemap->add(
            Url::create(route('pages',['slug' => 'video'])) // URL untuk halaman beranda
                ->setPriority(1.0) // Prioritas tertinggi untuk beranda
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY) // Halaman beranda sering diperbarui
        );
        
        foreach ($albums as $album) {
            if($album->galleries){
                $sitemap->add(
                    Url::create(route('gallery.show', ['id' => $album->id])) // URL untuk galeri
                        ->setPriority(0.5)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            }
        }

        // Menambahkan URL untuk halaman anggota
        $sitemap->add(
            Url::create(route('members')) // URL untuk halaman anggota
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        );

        // Menyimpan sitemap ke file
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return redirect()->back()->with('success', 'Sitemap berhasil digenerate');
    }
}
