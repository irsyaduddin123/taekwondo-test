<?php

namespace App\Http\Controllers;

use App\Models\Microcycle;
use App\Models\Plan;
use Illuminate\Http\Request;

class MicrocycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $plans = Plan::all();
        return view('admin.anual-plan.microcycles.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'week' => 'required|integer'
        ]);

        Microcycle::create($request->all());
        return redirect()->route('plans.show', $request->plan_id)->with('success', 'Microcycle created successfully.');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
