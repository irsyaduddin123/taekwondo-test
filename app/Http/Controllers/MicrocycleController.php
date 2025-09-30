<?php

namespace App\Http\Controllers;

use App\Models\Microcycle;
use App\Models\Plan;
use Illuminate\Http\Request;

class MicrocycleController extends Controller
{
    public function index()
    {
        $plans = Plan::with('microcycles')->get();
        return view('admin.anual-plan.microcycles.index', compact('plans'));
    }

    // Store Plan
    public function storePlan(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'tahun' => 'required|integer',
        ]);

        Plan::create($request->only(['nama', 'tahun']));
        return back()->with('success', 'Plan berhasil ditambahkan.');
    }

    // Store Microcycle
// Store Microcycle
    public function storeMicrocycle(Request $request, $planId)
    {
        $request->validate([
            'minggu'     => 'required|integer',
            'fase'       => 'required|string|max:255',
            'tahap'      => 'required|string|max:255',
            'load'       => 'required|integer',
            'phys_prep'  => 'required|integer',
            'tech_prep'  => 'required|integer',
            'volume'     => 'required|integer',
            'intensity'  => 'required|integer',
        ]);

        Microcycle::create([
            'plan_id'   => $planId,
            'minggu'    => $request->minggu,
            'fase'      => $request->fase,
            'tahap'     => $request->tahap,
            'load'      => $request->load,
            'phys_prep' => $request->phys_prep,
            'tech_prep' => $request->tech_prep,
            'volume'    => $request->volume,
            'intensity' => $request->intensity,
        ]);

        return back()->with('success', 'Microcycle berhasil ditambahkan.');
    }


    // Update Plan
    public function updatePlan(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'tahun' => 'required|integer',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update($request->only(['nama', 'tahun']));

        return back()->with('success', 'Plan berhasil diperbarui.');
    }

    // Update Microcycle
    public function updateMicrocycle(Request $request, $id)
    {
        $request->validate([
            'minggu'     => 'required|integer',
            'fase'       => 'required|string|max:255',
            'tahap'      => 'required|string|max:255',
            'load'       => 'required|integer',
            'phys_prep'  => 'required|integer',
            'tech_prep'  => 'required|integer',
            'volume'     => 'required|integer',
            'intensity'  => 'required|integer',
        ]);

        $mc = Microcycle::findOrFail($id);
        $mc->update($request->only([
            'minggu', 'fase', 'tahap', 'load',
            'phys_prep', 'tech_prep', 'volume', 'intensity'
        ]));

        return back()->with('success', 'Microcycle berhasil diperbarui.');
    }



    // Hapus Plan
    public function destroyPlan($id)
    {
        Plan::findOrFail($id)->delete();
        return back()->with('success', 'Plan berhasil dihapus.');
    }

    // Hapus Microcycle
    public function destroyMicrocycle($id)
    {
        Microcycle::findOrFail($id)->delete();
        return back()->with('success', 'Microcycle berhasil dihapus.');
    }
}
