<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
    public function index()
    {
        // Logic to display post socials
        $socials = SocialMedia::all();
        return view('admin.social-medias.index', compact('socials'));
    }

    public function saveSocialMedia(Request $request)
    {
        $validator = [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'url' => 'required|url',
            'is_active' => 'nullable|boolean'
        ];

        $isValid = Validator::make($request->all(),$validator);

        if($isValid->fails()){
            // Mengembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withErrors($isValid->errors())->withInput();
        }

        // Validasi berhasil, lanjutkan dengan penyimpanan data
        $data = $request->only(['name', 'icon', 'url', 'is_active']);  // ambil hanya data yang dibutuhkan

        $message = $request->has('id') ? 'Social media berhasil diperbaharui' : 'Social Media Berhasil Ditambahkan';

        SocialMedia::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.socials.index')->with('success', $message);
    }

    public function destroySocialMedia($id)
    {
        $social = SocialMedia::findOrFail($id);
        $social->delete();
        return redirect()->route('admin.socials.index')->with('success', 'Social Media berhasil dihapus!');
    }
}
