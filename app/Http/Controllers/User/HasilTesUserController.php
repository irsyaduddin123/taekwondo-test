<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HasilTesUserController extends Controller
{
    //
        public function index()
    {
        $athleteId = Auth::id(); // ambil ID user yang login

        $results = DB::table('test_results as t')
            ->join('athletes as a', 't.athlete_id', '=', 'a.id')
            ->join('test_components as tc', 't.test_component_id', '=', 'tc.id')
            ->select('t.id', 'a.name as athlete_name', 'tc.nama_komponen as component_name', 't.score', 't.test_date')
            ->where('a.user_id', Auth::id()) 
            ->orderBy('t.test_date', 'desc')
            ->get();

        return view('user.hasiltesuser.index', compact('results'));
    }
}
