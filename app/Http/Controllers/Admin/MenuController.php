<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    // Mengelola Menu
    public function index()
    {
        $menus = Menu::orderBy('order', 'asc')->get();
        $maxOrder = Menu::max('order') ?? 0;
        return view('admin.menus.index', compact('menus','maxOrder'));
    }

    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function saveMenu(Request $request)
    {
        $validator = [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];

        $data = $request->validate($validator);
        $data['slug'] = Str::slug($request->name);

        if($request->has('id')) {
            $message = 'Menu berhasil diperbarui!';
        } else {
            $message = 'Menu berhasil ditambahkan!';
        }

        Menu::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.menus.index')->with('success', $message);
    }
}
