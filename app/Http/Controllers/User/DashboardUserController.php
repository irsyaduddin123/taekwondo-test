<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\TestResult;
use App\Models\TestComponent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index(Request $request)
    {
        $athlete = Auth::user()->athlete;
        if(!$athlete){
            abort(403, 'athlete tidak ditemukan untuk user ini');
        }

        $athleteId        = $athlete->id;
        
        $komponenFisikId  = $request->input('komponen_fisik_id');
        $komponenTeknikId = $request->input('komponen_teknik_id');
        $komponenMentalId = $request->input('komponen_mental_id');

        // Inisialisasi array supaya aman
        $labelsUser          = [];
        $dataFisikUser       = [];
        $dataTeknikUser      = [];
        $dataMentalUser      = [];
        $dataPersenFisikUser = [];

        // Ambil daftar bulan & tahun unik dari test_results
        $bulanList = TestResult::selectRaw('YEAR(test_date) as tahun, MONTH(test_date) as bulan')
            ->where('athlete_id', $athleteId)
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        foreach ($bulanList as $row) {
            $labelsUser[] = Carbon::create($row->tahun, $row->bulan)->format('M Y');

            // Tes Fisik
            $queryFisik = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan)
                ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'fisik'));

            if ($athleteId) $queryFisik->where('athlete_id', $athleteId);
            if ($komponenFisikId) $queryFisik->where('test_component_id', $komponenFisikId);

            $dataFisikUser[] = round($queryFisik->avg('score') ?? 0, 2);

            // Tes Teknik
            $queryTeknik = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan)
                ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'teknik'));

            if ($athleteId) $queryTeknik->where('athlete_id', $athleteId);
            if ($komponenTeknikId) $queryTeknik->where('test_component_id', $komponenTeknikId);

            $dataTeknikUser[] = round($queryTeknik->avg('score') ?? 0, 2);

            // Tes Mental
            $queryMental = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan)
                ->whereHas('testComponent.type', fn($q) => $q->where('nama_jenis', 'mental'));

            if ($athleteId) $queryMental->where('athlete_id', $athleteId);
            if ($komponenMentalId) $queryMental->where('test_component_id', $komponenMentalId);

            $dataMentalUser[] = round($queryMental->avg('score') ?? 0, 2);

            // Persentase Fisik (rata-rata semua score)
            $queryPersen = TestResult::whereYear('test_date', $row->tahun)
                ->whereMonth('test_date', $row->bulan);

            if ($athleteId) $queryPersen->where('athlete_id', $athleteId);

            $dataPersenFisikUser[] = round($queryPersen->avg('score') ?? 0);
        }

        return view('user.dashboard-user.index', [
            'labelsUser'          => $labelsUser,
            'dataFisikUser'       => $dataFisikUser,
            'dataTeknikUser'      => $dataTeknikUser,
            'dataMentalUser'      => $dataMentalUser,
            'dataPersenFisikUser' => $dataPersenFisikUser,

            'semuaAtletUser'      => Athlete::all(),
            'komponenFisikUser'   => TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'fisik'))->get(),
            'komponenTeknikUser'  => TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'teknik'))->get(),
            'komponenMentalUser'  => TestComponent::whereHas('type', fn($q) => $q->where('nama_jenis', 'mental'))->get(),
        ]);
    }
}
