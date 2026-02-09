<?php

namespace App\Http\Controllers\Public;

use App\Models\Page;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\GalleryAlbum;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function home()
    {
        $beritas = Post::latest()->take(6)->get(); // Mengambil 3 berita terbaru
        $page = Page::where('slug', 'about-us')->first(); //ambil about us
        // Ambil halaman yang is_carousel-nya true
        $carousels = Page::where('is_carousel', true)->get();
        return view('public.home', compact('beritas','page','carousels'));
    }

    public function getpages(string $slug)
    {
        // Jika slug 'contact', langsung tampilkan view contact
        if ($slug === 'kontak') {
            return view('public.contact');
        }

        if(in_array($slug, ['gambar', 'video']))
        {
            $is_image = ($slug === 'gambar');
            $albums = GalleryAlbum::with(['galleries' => function($query) {
            $query->take(3); // Hanya 3 Gallery Gambar
            }])->where('is_image', $is_image)->withCount('galleries')->latest()->get();
            return view('public.gallery',compact('is_image','albums','slug'));
        }


        if($slug === 'member-prmi')
        {
            return redirect()->route('members');
        }
        
        if($slug === 'event')
        {
            $events = Event::where('is_active', true)->orderBy('tanggal_event', 'desc')->get();
            return view('public.event', compact('events'));
        }

        // Mencari halaman berdasarkan slug
        $page = Page::where('slug', $slug)->first();
        $viewed = Session::get('view_halaman', []);
        if (!in_array($page->id, $viewed)) {
            $page->increment('hits');
            Session::push('view_halaman', $page->id);
        }

        // Jika halaman tidak ditemukan, tampilkan 404
        return $page ? view('public.pages', compact('page')) : abort(404);
    }
    
    public function getGallery($id)
    {
        $album = GalleryAlbum::findOrFail($id);
        $slug = $album->is_image ? 'gambar' : 'video';
        return view('public.gallery-show', compact('album','slug'));
    }
    
    public function getEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('public.event-show', compact('event'));
    }

}


