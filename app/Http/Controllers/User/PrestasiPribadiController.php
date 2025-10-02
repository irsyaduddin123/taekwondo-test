<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HasilPrestasi;
use Illuminate\Http\Request;

class PrestasiPribadiController extends Controller
{
    // Tampilkan semua prestasi milik athlete yang login
    public function index()
    {
        $user = auth()->user();

        // Pastikan user punya relasi ke tabel athlete
        if (!$user->athlete) {
            abort(403, 'Akun ini tidak terkait dengan athlete.');
        }

        $prestasis = HasilPrestasi::where('athlete_id', $user->athlete->id)->get();

        return view('user.prestasi.index', compact('prestasis'));
    }

    // Update evaluasi pribadi saja
    public function update(Request $request, $id)
    {
        $prestasi = HasilPrestasi::findOrFail($id);

        // Validasi: hanya boleh edit milik sendiri
        if ($prestasi->athlete_id !== auth()->user()->athlete->id) {
            abort(403, 'Anda tidak boleh mengedit prestasi orang lain.');
        }

        $request->validate([
            'evaluasi_pribadi' => 'nullable|string|max:1000',
        ]);

        $prestasi->update([
            'evaluasi_pribadi' => $request->evaluasi_pribadi,
        ]);

        return redirect()
            ->route('user.prestasi.index')
            ->with('success', 'Evaluasi pribadi berhasil diperbarui.');
    }
}
