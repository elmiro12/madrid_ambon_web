<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function updateSetting(Request $request)
    {

        if(!$request->has('key')){
            return redirect()->back()->with('error', 'Key tidak ditemukan dalam request.');
        }

        $setting = Setting::where('key',$request->key)->first();
        if(!$setting){
            return redirect()->back()->with('error', 'pengaturan tidak ada');
        }

        //inisiasi
        $data_value = null;

        //jika inputan file
        if($request->hasFile('value'))
        {

            //validasi hanya gambar
            $request->validate([
                'value' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            ]);

            //inisialisasi
            $path = 'user';
            $image = $request->file('value');
            $imageName = $setting->key.'.' . $image->getClientOriginalExtension();

            if($setting->key == 'site_logo'){
                $path = 'logo';
                $imageName = 'logo_web.' . $image->getClientOriginalExtension();
            }

            //hapus file gambar jika ada
            if($setting->value && file_exists(public_path('assets/img/'.$path.'/'.$setting->value))){
                    unlink(public_path('assets/img/'.$path.'/'.$setting->value));
            }

            //simpan file jika sudah hapus
            $image->move(public_path('assets/img/'.$path), $imageName);
            $data_value = $imageName;

        }else{
            $request->validate([
                'value' => 'required|string|min:5|max:1000',
            ]);
            $data_value = $request->value;
        }

        $setting->update([
            'value' => $data_value,
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbaharui.');
    }
}
