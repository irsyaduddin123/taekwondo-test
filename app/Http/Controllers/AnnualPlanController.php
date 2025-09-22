<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class AnnualPlanController extends Controller
{
    public function index()
    {
        // Ambil 1 plan aktif (bisa disesuaikan pakai where status=aktif kalau ada)
        $plan = Plan::with(['microcycles', 'events', 'biomotors'])->first();

        if (!$plan) {
            return redirect()->back()->with('error', 'Belum ada plan aktif.');
        }

        // Label Minggu
        $labels = $plan->microcycles->pluck('minggu')->map(function ($minggu) {
            return "Minggu ke-" . $minggu;
        });

        // Data periodisasi
        $physPrep  = $plan->microcycles->pluck('phys_prep');
        $techPrep  = $plan->microcycles->pluck('tech_prep');
        $volume    = $plan->microcycles->pluck('volume');
        $intensity = $plan->microcycles->pluck('intensity');

        // Data biomotor (per minggu)
        $biomotors = $plan->biomotors->groupBy('minggu');

        return view('admin.anual-plan.index', compact(
            'plan',
            'labels',
            'physPrep',
            'techPrep',
            'volume',
            'intensity'
        ));
    }
}
