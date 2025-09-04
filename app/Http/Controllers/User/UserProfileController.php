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
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo_url && Storage::disk('public')->exists($user->profile_photo_url)) {
            Storage::disk('public')->delete($user->profile_photo_url);
        }

        // Simpan foto baru ke storage/app/public/profile
        $path = $request->file('photo')->store('profile', 'public');

        // Simpan ke database
        $user->profile_photo_url = $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
