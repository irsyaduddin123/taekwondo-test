<?php

namespace App\Http\Controllers;

use App\Models\Biomotor;
use App\Models\Plan;
use Illuminate\Http\Request;

class BiomotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    //         $plan = Plan::findOrFail($planId);

    // // group biomotor by minggu
    // $biomotors = Biomotor::where('plan_id',$planId)
    //     ->orderBy('minggu','asc')
    //     ->get()
    //     ->groupBy('minggu');

    return view('admin.anual-plan.biomotor.index', compact('plan','biomotors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
