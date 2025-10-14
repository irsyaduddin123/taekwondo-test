<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class AnnualPlanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua plan untuk dropdown
        $allPlans = Plan::orderBy('tahun', 'desc')->get();

        // Cek apakah user memilih plan tertentu
        $selectedPlanId = $request->get('plan_id');

        $plan = null;
        $labels = $physPrep = $techPrep = $volume = $intensity = [];

        if ($selectedPlanId) {
            $plan = Plan::with(['microcycles', 'events', 'biomotors', 'skills'])
                ->find($selectedPlanId);

            if ($plan) {
                // Label Minggu
                $labels = $plan->microcycles->pluck('minggu')->map(fn($m) => "Minggu ke-" . $m);

                // Data periodisasi
                $physPrep  = $plan->microcycles->pluck('phys_prep');
                $techPrep  = $plan->microcycles->pluck('tech_prep');
                $volume    = $plan->microcycles->pluck('volume');
                $intensity = $plan->microcycles->pluck('intensity');
            }
        }

        return view('admin.anual-plan.index', compact(
            'allPlans',
            'plan',
            'labels',
            'physPrep',
            'techPrep',
            'volume',
            'intensity',
            'selectedPlanId'
        ));
    }
}
