<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Ambil data tervalidasi kecuali photo
        $request->user()->fill($request->safe()->except(['photo']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('photo')) {
            $oldPhoto = $request->user()->getOriginal('photo'); // Ambil foto lama dari database (original state) - ATAU gunakan variabel sebelum fill jika perlu. Tapi getOriginal aman.
            
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Hapus foto lama jika ada dan bukan default/bawaan seeder
            if ($oldPhoto && $oldPhoto !== 'default.png' && $oldPhoto !== 'logo.png' && file_exists(public_path('assets/img/user/' . $oldPhoto))) {
                 unlink(public_path('assets/img/user/' . $oldPhoto));
            }

            // Gunakan copy alih-alih move untuk menghindari error FileNotFoundException jika request mengakses file temp lagi
            copy($image->getRealPath(), public_path('assets/img/user/') . $imageName);
            $request->user()->photo = $imageName;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
