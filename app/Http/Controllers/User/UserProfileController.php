<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Update foto profil user.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|max:2048', // 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // delete file lama
            if ($user->profile_photo_url && file_exists(public_path('storage/' . $user->profile_photo_url))) {
                unlink(public_path('storage/' . $user->profile_photo_url));
            }

            // upload baru
            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public');

            // simpan ke database
            $user->profile_photo_url = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }
}
