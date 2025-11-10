<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\TestResult;
use App\Models\TestComponent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->format('m-d');

        $ultahHariIni = Athlete::whereRaw("DATE_FORMAT(birthdate, '%m-%d') = ?", [$today])->get();

        $athleteId = $request->input('athlete_id');
        $komponenFisikId = $request->input('komponen_fisik_id');
        $komponenTeknikId = $request->input('komponen_teknik_id');
        $komponenMentalId = $request->input('komponen_mental_id');

        // Jumlah Tes Fisik & Teknik berdasarkan relasi type
        $totfisiktes = TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'fisik'))->count();
        $tottekniktes = TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'teknik'))->count();
        $totmentaltes = TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'mental'))->count();

        $labels = [];
        $dataFisik = [];
        $dataTeknik = [];
        $dataPersenFisik = [];
        $dataMental = [];

        // Ambil daftar bulan & tahun unik dari test_results
        $bulanList = TestResult::selectRaw('YEAR(test_date) as tahun, MONTH(test_date) as bulan')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        foreach ($bulanList as $row) {
            $labels[] = Carbon::create($row->tahun, $row->bulan)->format('M Y');

            // --- Tes Fisik ---
            $queryFisik = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan)
                ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'fisik'));

            if ($athleteId) $queryFisik->where('athlete_id', $athleteId);
            if ($komponenFisikId) $queryFisik->where('test_component_id', $komponenFisikId);

            $dataFisik[] = round($queryFisik->avg('score') ?? 0, 2);

            // --- Tes Teknik ---
            $queryTeknik = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan)
                ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'teknik'));

            if ($athleteId) $queryTeknik->where('athlete_id', $athleteId);
            if ($komponenTeknikId) $queryTeknik->where('test_component_id', $komponenTeknikId);

            $dataTeknik[] = round($queryTeknik->avg('score') ?? 0, 2);

             // --- Tes Fisik ---
            $queryMental = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan)
                ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'mental'));

            if ($athleteId) $queryMental->where('athlete_id', $athleteId);
            if ($komponenMentalId) $queryMental->where('test_component_id', $komponenMentalId);

            $dataMental[] = round($queryMental->avg('score') ?? 0, 2);

            // --- Persentase Fisik ---
            $queryPersen = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan);
                // ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'fisik'));

            if ($athleteId) $queryPersen->where('athlete_id', $athleteId);

            $dataPersenFisik[] = round($queryPersen->avg('score') ?? 0);
        }

        return view('dashboard', [
            'jumlahAtlet' => Athlete::count(),
            'ultahHariIni' => $ultahHariIni,
            'tesFisik' => $totfisiktes,
            'tesTeknik' => $tottekniktes,
            'tesMental' => $totmentaltes,
            
            'labels' => $labels,
            'dataFisik' => $dataFisik,
            'dataTeknik' => $dataTeknik,
            'dataMental' => $dataMental,
            'dataPersenFisik' => $dataPersenFisik,
            'semuaAtlet' => Athlete::all(),
            'komponenFisik' => TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'fisik'))->get(),
            'komponenTeknik' => TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'teknik'))->get(),
        ]);
    }
}
