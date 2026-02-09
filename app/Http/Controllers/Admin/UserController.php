<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function saveUser(Request $request)
    {
        $validator = [
            'name' => 'required|string|max:255',
            'role' => 'required|in:editor,admin',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048'
        ];

        if ($request->has('id')) {
            if($request->filled('password')){
                $validator['password'] = 'required|min:8|confirmed';
            }
            $validator['email'] = 'required|email|unique:users,email,'.$request->id;
            $message = 'Pengguna berhasil diperbarui!';
        } else {
            $validator['email'] = 'required|email|unique:users,email';
            $validator['password'] = 'required|min:8|confirmed';
            $message = 'Pengguna berhasil ditambahkan!';
        }
        $data = $request->validate($validator);
        
        // Hash password jika ada
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }
        
        // Upload gambar
        $imageName = null;
        if ($request->hasFile('photo')) {
            
            //cek foto sekarang
            if ($request->has('id')) {
                $user = User::findOrFail($request->id);
                if($user->photo && file_exists(public_path('assets/img/user/'.$user->photo))){
                    unlink(public_path('assets/img/user/'.$user->photo));
                }
            }
            
            $image = $request->file('photo');
            $imageName = 'user_img_'. time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img/user'), $imageName);
            $data['photo'] = $imageName;
        }
        
        
        User::updateOrCreate(['id' => $request->id], $data);
        return redirect()->route('admin.users.index')->with('success', $message);
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if(!$user){
            return redirect()->back()->with('Error', 'Pengguna tidak ditemukan');
        }
        if($user->photo && file_exists(public_path('assets/img/user/'.$user->photo))){
            unlink(public_path('assets/img/user/'.$user->photo));
        }
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','Pengguna Berhasil Dihapus !');
    }
}
