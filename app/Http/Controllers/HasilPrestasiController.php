<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\HasilPrestasi;
use Illuminate\Http\Request;

class HasilPrestasiController extends Controller
{
    public function index()
    {
        // Ambil semua athlete dengan prestasinya
        $athletes = Athlete::with('hasilPrestasis')->get();

        return view('admin.prestasi.index', compact('athletes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'athlete_id'          => 'required|exists:athletes,id',
            'nama_kejuaraan'      => 'required|string|max:255',
            'kelas_pertandingan'  => 'required|string|max:255',
            'hasil_pertandingan'  => 'required|string|max:255',
            'evaluasi_pelatih'    => 'nullable|string',
        ]);

        HasilPrestasi::create($request->only([
            'athlete_id',
            'nama_kejuaraan',
            'kelas_pertandingan',
            'hasil_pertandingan',
            'evaluasi_pelatih'
        ]));

        return redirect()
            ->route('hasil-prestasi.index')
            ->with('success', 'Hasil prestasi berhasil ditambahkan');
    }

    public function update(Request $request, HasilPrestasi $prestasi)
    {
        $request->validate([
            'nama_kejuaraan'      => 'required|string|max:255',
            'kelas_pertandingan'  => 'required|string|max:255',
            'hasil_pertandingan'  => 'required|string|max:255',
            'evaluasi_pelatih'    => 'nullable|string',
        ]);

        $prestasi->update($request->only([
            'nama_kejuaraan',
            'kelas_pertandingan',
            'hasil_pertandingan',
            'evaluasi_pelatih'
        ]));

        return redirect()
            ->route('hasil-prestasi.index')
            ->with('success', 'Hasil prestasi berhasil diperbarui');
    }

    public function destroy(HasilPrestasi $prestasi)
    {
        $prestasi->delete();

        return redirect()
            ->route('hasil-prestasi.index')
            ->with('success', 'Hasil prestasi berhasil dihapus');
    }
}
