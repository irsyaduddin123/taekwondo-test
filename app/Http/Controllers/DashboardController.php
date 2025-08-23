<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\TestResult;
use App\Models\TestComponent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
//    public function index(Request $request)
//     {
//         $athleteId = $request->input('athlete_id');
//         $komponenFisikId = $request->input('komponen_fisik_id');
//         $komponenTeknikId = $request->input('komponen_teknik_id');
//         $totfisiktes = TestComponent::where('jenis', 'fisik')->count();
//         $tottekniktes = TestComponent::where('jenis', 'teknik')->count();


//         $labels = [];
//         $dataFisik = [];
//         $dataTeknik = [];
//         $dataPersenFisik = [];
//         $bulanSekarang = now();

//         for ($i = 5; $i >= 0; $i--) {
//             $bulan = $bulanSekarang->copy()->subMonths($i);
//             $labels[] = $bulan->format('M Y');

//             // -- Tes Fisik (Bar & Line)
//             $queryFisik = TestResult::whereMonth('test_date', $bulan->month)
//                 ->whereYear('test_date', $bulan->year)
//                 ->whereHas('testComponent', fn($q) => $q->where('jenis', 'fisik'));

//             if ($athleteId) $queryFisik->where('athlete_id', $athleteId);
//             if ($komponenFisikId) $queryFisik->where('test_component_id', $komponenFisikId);

//             $avgFisik = round($queryFisik->avg('score') ?? 0, 2);
//             $dataFisik[] = $avgFisik;

//             // -- Tes Teknik
//             $queryTeknik = TestResult::whereMonth('test_date', $bulan->month)
//                 ->whereYear('test_date', $bulan->year)
//                 ->whereHas('testComponent', fn($q) => $q->where('jenis', 'teknik'));

//             if ($athleteId) $queryTeknik->where('athlete_id', $athleteId);
//             if ($komponenTeknikId) $queryTeknik->where('test_component_id', $komponenTeknikId);

//             $avgTeknik = round($queryTeknik->avg('score') ?? 0, 2);
//             $dataTeknik[] = $avgTeknik;
//         }

//         // -- Presentase Fisik Keseluruhan (HANYA dari filter nama atlet, tanpa komponen)
//         for ($i = 5; $i >= 0; $i--) {
//             $bulan = $bulanSekarang->copy()->subMonths($i);

//             $query = TestResult::whereMonth('test_date', $bulan->month)
//                 ->whereYear('test_date', $bulan->year)
//                 ->whereHas('testComponent', fn($q) => $q->where('jenis', 'fisik'));

//             if ($athleteId) {
//                 $query->where('athlete_id', $athleteId);
//             }

//             $avg = round($query->avg('score') ?? 0);
//             $dataPersenFisik[] = $avg;
//         }

//         return view('dashboard', [
//             'jumlahAtlet' => Athlete::count(),
//             'tesFisik' => $totfisiktes,
//             'tesTeknik' => $tottekniktes,
//             'labels' => $labels,
//             'dataFisik' => $dataFisik,
//             'dataTeknik' => $dataTeknik,
//             'dataPersenFisik' => $dataPersenFisik,
//             'semuaAtlet' => Athlete::all(),
//             'komponenFisik' => TestComponent::where('jenis', 'fisik')->get(),
//             'komponenTeknik' => TestComponent::where('jenis', 'teknik')->get(),
//         ]);
//     }


public function index(Request $request)
{
    $athleteId = $request->input('athlete_id');
    $komponenFisikId = $request->input('komponen_fisik_id');
    $komponenTeknikId = $request->input('komponen_teknik_id');
    $totfisiktes = TestComponent::where('jenis', 'fisik')->count();
    $tottekniktes = TestComponent::where('jenis', 'teknik')->count();

    $labels = [];
    $dataFisik = [];
    $dataTeknik = [];
    $dataPersenFisik = [];

    // 🔹 Ambil semua bulan & tahun unik dari database test_results
    $bulanList = TestResult::selectRaw('YEAR(test_date) as tahun, MONTH(test_date) as bulan')
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun')
        ->orderBy('bulan')
        ->get();

    foreach ($bulanList as $row) {
        $labels[] = \Carbon\Carbon::create($row->tahun, $row->bulan)->format('M Y');

        // Tes Fisik
        $queryFisik = TestResult::whereYear('test_date', $row->tahun)
            ->whereMonth('test_date', $row->bulan)
            ->whereHas('testComponent', fn($q) => $q->where('jenis', 'fisik'));

        if ($athleteId) $queryFisik->where('athlete_id', $athleteId);
        if ($komponenFisikId) $queryFisik->where('test_component_id', $komponenFisikId);

        $avgFisik = round($queryFisik->avg('score') ?? 0, 2);
        $dataFisik[] = $avgFisik;

        // Tes Teknik
        $queryTeknik = TestResult::whereYear('test_date', $row->tahun)
            ->whereMonth('test_date', $row->bulan)
            ->whereHas('testComponent', fn($q) => $q->where('jenis', 'teknik'));

        if ($athleteId) $queryTeknik->where('athlete_id', $athleteId);
        if ($komponenTeknikId) $queryTeknik->where('test_component_id', $komponenTeknikId);

        $avgTeknik = round($queryTeknik->avg('score') ?? 0, 2);
        $dataTeknik[] = $avgTeknik;

        // Persentase Fisik (tanpa filter komponen)
        $queryPersen = TestResult::whereYear('test_date', $row->tahun)
            ->whereMonth('test_date', $row->bulan)
            ->whereHas('testComponent', fn($q) => $q->where('jenis', 'fisik'));

        if ($athleteId) $queryPersen->where('athlete_id', $athleteId);

        $avgPersen = round($queryPersen->avg('score') ?? 0);
        $dataPersenFisik[] = $avgPersen;
    }

    return view('dashboard', [
        'jumlahAtlet' => Athlete::count(),
        'tesFisik' => $totfisiktes,
        'tesTeknik' => $tottekniktes,
        'labels' => $labels,
        'dataFisik' => $dataFisik,
        'dataTeknik' => $dataTeknik,
        'dataPersenFisik' => $dataPersenFisik,
        'semuaAtlet' => Athlete::all(),
        'komponenFisik' => TestComponent::where('jenis', 'fisik')->get(),
        'komponenTeknik' => TestComponent::where('jenis', 'teknik')->get(),
    ]);
}
}

