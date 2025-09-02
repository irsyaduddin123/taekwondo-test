<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Athlete;

class PenggunaController extends Controller
{
    //
        public function index()
    {
        return view('admin.pengguna', [
            'users' => User::all(),
            'athletes' => Athlete::all(),
        ]);
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|in:user,athlete,admin',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role user berhasil diperbarui');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
        ]);

        $athlete = Athlete::findOrFail($id);
        $athlete->user_id = $request->user_id ?: null;
        $athlete->save();

        return back()->with('success', 'User untuk atlet berhasil diperbarui');
    }
}
