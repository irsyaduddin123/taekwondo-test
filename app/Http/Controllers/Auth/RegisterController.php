<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/dashboard');
            }

            if ($user->role === 'user') {
                return redirect('/user');
            }

            return redirect('/');
        }

        return view('auth.register'); // ganti sesuai nama blade register kamu
    }

    /**
     * Proses register user baru
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default user biasa
        ]);

        // Auto login setelah register
        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }

        if ($user->role === 'user') {
            return redirect('/user');
        }

        return redirect('/');
    }
}
