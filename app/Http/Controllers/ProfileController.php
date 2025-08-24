<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'photo.max' => 'Ukuran file tidak boleh lebih dari 2 MB.', // custom message
        'photo.required' => 'Silakan pilih file foto.',
        'photo.image' => 'File harus berupa gambar.',
        'photo.mimes' => 'Format file harus jpg, jpeg, atau png.',
    ]);

    $user = auth()->user();

    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($user->profile_photo_url && file_exists(storage_path('app/public/' . $user->profile_photo_url))) {
            @unlink(storage_path('app/public/' . $user->profile_photo_url));
        }

        // Simpan file baru ke storage/app/public/profile-photos
        $path = $request->file('photo')->store('profile-photos', 'public');

        // Simpan path relatif ke DB
        $user->profile_photo_url = $path;
        $user->save();
    }

    return back()->with('success', 'Foto profil berhasil diperbarui!');
}



}
