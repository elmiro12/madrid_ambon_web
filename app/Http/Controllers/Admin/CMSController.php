<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CMSController extends Controller
{

    public function dashboard()
    {
        // Ambil data penting untuk dashboard jika diperlukan, seperti jumlah menu, halaman, post, dll.
        $menuCount = Menu::count();
        $pageCount = Page::count();
        $postCount = Post::count();
        $userCount = User::count();
        $categoryCount = PostCategory::count();
        $socialCount = SocialMedia::count();

        return view('admin.dashboard', compact('menuCount', 'pageCount', 'postCount','userCount','categoryCount','socialCount'));
    }

    // Mengelola Halaman Statis
    public function managePages()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function createPages(){
        return view('admin.pages.create');
    }

    public function editPages($id){
        $page = Page::findOrFail($id);
        // Jika halaman tidak ditemukan, tampilkan 404
        return $page ? view('admin.pages.edit', compact('page')) : abort(404);
    }

    public function showPages($id)
    {
        $page = Page::findOrFail($id);
        // Jika halaman tidak ditemukan, tampilkan 404
        return $page ? view('admin.pages.show', compact('page')) : abort(404);
    }

    public function savePage(Request $request)
    {
        $validator = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'menu_id' => 'nullable|exists:menus,id',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'is_active' => 'required|boolean',
            'is_carousel' => 'nullable|boolean',
        ];
        $data = $request->validate($validator);

        // Upload gambar
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img/berita'), $imageName);
            $data['image'] = $imageName;
        }

        $data['slug'] = Str::slug($request->title);
        if (!$request->has('id')){
            $data['hits'] = 0;
        }
         // Inisialisasi hits dengan 0
        $message = $request->has('id') ? 'Halaman berhasil diperbarui!' : 'Halaman berhasil ditambahkan!';

        Page::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.pages.index')->with('success', $message);
    }

    public function destroyPages($id){
        $page = Page::findOrFail($id);
        if(!$page){
            return redirect()->back()->with('error','Halaman Tidak ditemukan');
        }
        if($page->image && file_exists(public_path('assets/img/berita/'.$page->image))){
            unlink(public_path('assets/img/berita/'.$page->image));
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Halaman Berhasil Dihapus');

    }

    // Mengelola Berita
    public function managePosts()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function createPost()
    {
        return view('admin.post.create');
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        if(!$post){
            abort(404);
        }

        return view('admin.post.edit', compact('post'));
    }

    public function showPost($id)
    {
        $post = Post::findOrFail($id);
        if(!$post){
            abort(404);
        }

        return view('admin.pages.show', compact('post'));
    }

    public function savePost(Request $request)
    {
        $validator = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'summary' => 'required|string',
            'keywords' => 'nullable|string',
            'category_id' => 'required|exists:post_categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'is_published' => 'required|boolean',
        ];

        $data = $request->validate($validator);
        // Upload gambar
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img/berita'), $imageName);
        }

        $data['image'] = $imageName;
        $data['slug'] = Str::slug($request->title);

        if (!$request->has('id')){
            $data['hits'] = 0;
        }

        $message = $request->has('id') ? 'Berita Berhasil Diperbaharui' : 'Berita Berhasil ditambahkan';

        Post::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.posts.index')->with('success',$message);
    }

    public function destroyPost($id)
    {
       $post = Post::findOrFail($id);
        if(!$post){
            abort(404);
        }
        if($post->image && file_exists(public_path('assets/img/berita/'.$post->image))){
            unlink(public_path('assets/img/berita/'.$post->image));
        }

        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Berita Berhasil Dihapus');
    }

    //tinyMCE
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('uploads/berita'), $filename);

            return response()->json([
                'location' => asset('uploads/berita/' . $filename)
            ]);
        }
        return response()->json(['error' => 'Tidak ada file diupload'], 400);
    }
}
