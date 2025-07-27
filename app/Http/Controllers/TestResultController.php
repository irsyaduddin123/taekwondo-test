<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\TestComponent;
use App\Models\TestResult;
use Illuminate\Http\Request;
    use Barryvdh\DomPDF\Facade\Pdf;

class TestResultController extends Controller
{
    public function index(Request $request)
    {
        $query = TestResult::with(['athlete', 'testComponent']);

        if ($request->filled('athlete')) {
            $query->whereHas('athlete', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->athlete . '%');
            });
        }

        if ($request->filled('component_id')) {
            $query->where('test_component_id', $request->component_id);
        }

        if ($request->filled('month')) {
            $query->whereMonth('test_date', $request->month);
        }

        $results = $query->get();
        $components = TestComponent::all();
        $months = TestResult::selectRaw('MONTH(test_date) as month')->distinct()->pluck('month');

        return view('admin.test_results.index', compact('results', 'components', 'months'));
    }

    public function create()
    {
        $athletes = Athlete::all();
        $components = TestComponent::all();
        return view('admin.test_results.create', compact('athletes', 'components'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'athlete_id' => 'required|exists:athletes,id',
            'test_component_id' => 'required|exists:test_components,id',
            'nilai' => 'required|numeric|min:0',
            'test_date' => 'required|date',
        ]);

        TestResult::create([
            'athlete_id' => $request->athlete_id,
            'test_component_id' => $request->test_component_id,
            'score' => $request->nilai,
            'test_date' => $request->test_date,
        ]);


        return redirect()->route('test_results.index')->with('success', 'Hasil tes berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $result = TestResult::findOrFail($id);
        $athletes = Athlete::all();
        $components = TestComponent::all();
        return view('admin.test_results.edit', compact('result', 'athletes', 'components'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'athlete_id' => 'required|exists:athletes,id',
            'test_component_id' => 'required|exists:test_components,id',
            'nilai' => 'required|numeric|min:0',
            'test_date' => 'required|date',
        ]);

        $result = TestResult::findOrFail($id);
        $result->update([
            'athlete_id' => $request->athlete_id,
            'test_component_id' => $request->test_component_id,
            'score' => $request->nilai,
            'test_date' => $request->test_date,
        ]);

        return redirect()->route('test_results.index')->with('success', 'Hasil tes berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $result = TestResult::findOrFail($id);
        $result->delete();

        return redirect()->route('test_results.index')->with('success', 'Hasil tes berhasil dihapus.');
    }



    public function exportPdf(Request $request)
    {
        $query = TestResult::with(['athlete', 'testComponent']);

        // Filter jika ada
        if ($request->filled('athlete')) {
            $query->whereHas('athlete', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->athlete . '%');
            });
        }

        if ($request->filled('component_id')) {
            $query->where('test_component_id', $request->component_id);
        }

        if ($request->filled('month')) {
            $query->whereMonth('test_date', $request->month);
        }

        $results = $query->get();

        $pdf = Pdf::loadView('admin.test_results.pdf', compact('results'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('Hasil-Tes-Atlet.pdf');
    }

}
