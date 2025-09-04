<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HasilTesUserController extends Controller
{
    public function index(Request $request)
    {
        $athleteId = Auth::id();

        $query = DB::table('test_results as t')
            ->join('athletes as a', 't.athlete_id', '=', 'a.id')
            ->join('test_components as tc', 't.test_component_id', '=', 'tc.id')
            ->join('component_types as ct', 'tc.jenis_id', '=', 'ct.id')
            ->select(
                't.id',
                'a.name as athlete_name',
                'tc.nama_komponen as component_name',
                'ct.nama_jenis as component_type',
                't.score',
                't.test_date'
            )
            ->where('a.user_id', $athleteId);

        // 🔹 Filter bulan & tahun (kalau dipilih user)
        if ($request->filled('bulan')) {
            $query->whereMonth('t.test_date', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('t.test_date', $request->tahun);
        }

        $results = $query->orderBy('t.test_date', 'desc')->get();

        // Group by type
        $groupedResults = $results->groupBy('component_type');

        // 🔹 Ambil list tahun unik dari database untuk pilihan dropdown
        $availableYears = DB::table('test_results')->selectRaw('YEAR(test_date) as year')->distinct()->pluck('year');

        return view('user.hasiltesuser.index', compact('groupedResults', 'availableYears'));
    }
}
