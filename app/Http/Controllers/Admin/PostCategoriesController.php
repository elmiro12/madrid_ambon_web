<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoriesController extends Controller
{
    public function index()
    {
        // Logic to display post categories
        $categories = PostCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function saveCategory(Request $request)
    {
        $validator = [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ];

        $data = $request->validate($validator);
        $data['slug'] = Str::slug($request->name);

        if ($request->has('id')) {
            $message = 'Kategori berhasil diperbarui!';
        } else {
            $message = 'Kategori berhasil ditambahkan!';
        }

        PostCategory::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.categories.index')->with('success', $message);
    }

    public function destroyCategory($id)
    {
        $category = PostCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
