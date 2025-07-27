<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\TestResult;
use App\Models\TestComponent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $jumlahAtlet = Athlete::count();
    

    $tesFisik = TestResult::whereHas('testComponent', function ($query) {
        $query->where('jenis', 'fisik');
    })->count();

    $tesTeknik = TestResult::whereHas('testComponent', function ($query) {
        $query->where('jenis', 'teknik');
    })->count();
    

    return view('dashboard', compact('jumlahAtlet', 'tesFisik', 'tesTeknik'));
}
}

