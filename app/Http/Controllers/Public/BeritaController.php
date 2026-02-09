<?php

namespace App\Http\Controllers\Public;

use App\Models\Post;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Post::where('is_published', true)
            ->with('category') // Eager load the category relationship
            ->orderBy('published_at', 'desc') // Order by published date
            ->paginate(6); // Mengambil 6 berita terbaru
        $categoryName = 'none'; // Default category name
        return view('public.berita.index', compact('beritas','categoryName'));
    }

    public function category(string $slug)
    {
        $beritas = Post::whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->latest()->paginate(6);
        $categoryName = PostCategory::where('slug', $slug)->first()->name ?? 'none';
        return view('public.berita.index', compact('beritas','categoryName'));
    }

    public function show(string $slug)
    {
        $berita = Post::where('slug', $slug)->firstOrFail();
        $viewed = Session::get('view_berita', []);
        if (!in_array($berita->id, $viewed)) {
            $berita->increment('hits');
            Session::push('view_berita', $berita->id);
        }

        return view('public.berita.show', compact('berita'));
    }
}
