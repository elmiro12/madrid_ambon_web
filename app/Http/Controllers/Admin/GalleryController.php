<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Support\Str;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
   public function listGambar()
    {
        $albums = GalleryAlbum::with(['galleries' => function($query) {
            $query->take(3); // Hanya 3 Gallery Gambar
        }])->where('is_image', true)->withCount('galleries')->latest()->get();

        $slug = 'gambar';
        return view('admin.gallery.index', compact('albums', 'slug'));
    }

    public function listVideo()
    {
        $albums = GalleryAlbum::with(['galleries' => function($query) {
            $query->take(3); // Hanya mengambil 3 gallery video
        }])->where('is_image', false)->withCount('galleries')->latest()->get();

        $slug = 'video';
        return view('admin.gallery.index', compact('albums', 'slug'));
    }

    public function createGallery(string $slug)
    {
        $is_image = $slug === 'gambar' ? true:false;
        return view('admin.gallery.create', compact('is_image','slug'));
    }

    public function editGallery($id)
    {
        $gallery = GalleryAlbum::findOrFail($id);
        if(!$gallery){
            abort(404);
        }
        $is_image = true;
        $slug = 'gambar';
        if(!$gallery->is_image){
          $is_image = false;
          $slug = 'video';
        }

        return view('admin.gallery.edit', compact('gallery','is_image','slug'));
    }

    public function saveGallery(Request $request)
    {
        //inisiasi validasi data utama
        $validator = [
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ];

        //inisiasi slug untuk pindah view berdasarkan jenis
        $slug = 'gambar';

        //cek jenis gallery untuk validasi
        if($request->is_image == true){
            $validator['images'] = 'nullable|array';
            $validator['images.*'] = 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048';
        }else{
            $validator['video_embed'] = 'nullable|array';
            $validator['video_embed.*'] = 'string|min:10|max:1000';
            $slug = 'video';
        }

        //validasi form
        $data = $request->validate($validator);

        // Upload gambar
        $imageName = null;
        $editMode = false;

        // Cek jika mode edit atau create
        $album = null;
        if ($request->has('id')) {
            // Edit mode, gunakan nama folder lama
            $album = GalleryAlbum::find($request->id);
            $folderName = $album->name; // Tetap menggunakan nama folder lama
            $album->update([
                    'title' => $data['title'],
                    'deskripsi' => $data['deskripsi'],
                    'is_image' => $request->is_image,
                ]);
        } else {
            // Create mode, buat nama folder berdasarkan slug title
            $folderName = Str::slug($data['title']); // Buat nama folder berdasarkan slug title
            // Create album baru
            $album = GalleryAlbum::create([
                'title' => $data['title'],
                'name' => $folderName, // Nama folder dibuat berdasarkan slug title
                'deskripsi' => $data['deskripsi'],
                'is_image' => $request->is_image,
            ]);
        }

        if($request->is_image == true && $request->has('images') && !empty($data['images'])) {
            foreach ($data['images'] as $image){
                $imageName = time() . '_' .$image->getClientOriginalName();
                 // Tentukan path folder tempat menyimpan gambar
                $folderPath = 'gallery/' . $album->name;

                $image->storeAs($folderPath, $imageName,'public');
                // Simpan gallery gambar
                Gallery::create([
                    'album_id' => $album->id,
                    'images' => $imageName,
                ]);
            }
        }

        //simpan jika video
        if($request->is_image == false && $request->has('video_embed') && !empty($data['video_embed'])) {
            foreach ($data['video_embed'] as $embedCode) {
                // Simpan gallery video
                Gallery::create([
                    'album_id' => $album->id,
                    'video_embed' => $embedCode,
                ]);
            }
        }

        $message = $request->has('id') ? 'Gallery berhasil diperbarui!' : 'Gallery berhasil ditambahkan!';
        return redirect()->route('admin.gallery.'.$slug)->with('success',$message);
    }

    public function showGallery($id){
        $album = GalleryAlbum::findOrFail($id);
        if(!$album){
            return redirect()->back()->with('error','Gallery tidak ditemukan');
        }
        $slug = $album->is_image ? 'gambar' : 'video';
        return view('admin.gallery.show',compact('album', 'slug'));
    }

    public function destroyGallery($id){
        $gallery = GalleryAlbum::with('galleries')->findOrFail($id);
        if(!$gallery){
            return redirect()->back()->with('error','Gallery tidak ditemukan');
        }
        $slug = $gallery->is_image ? 'gambar' : 'video';
        // Jika album berjenis gambar, hapus gambar-gambar terkait dari folder
        if ($gallery->is_image) {
            $folderPath = 'gallery/'.$gallery->name;
            $publicStorage = Storage::disk('public');
            // Periksa apakah folder ada
            if ($publicStorage->exists($folderPath)) {
                // Hapus folder
                $publicStorage->deleteDirectory($folderPath);
            }
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.'.$slug)->with('success', ucwords($slug).'berhasil dihapus');
    }
    
    public function deleteGalleryItem($id){
        $galleryItem = Gallery::findOrFail($id);
        if(!$galleryItem){
           return redirect()->back()->with('error', 'Item tidak ditemukan');
        }
        $galleryItem->delete();
        return redirect()->back()->with('success', 'Item Berhasil Dihapus');

    }
}
