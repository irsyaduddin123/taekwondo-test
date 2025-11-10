<?php
namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    public function index()
    {
        $athletes = Athlete::all();
        return view('admin.athletes.index', compact('athletes'));
    }

    public function create()
    {
        return view('admin.athletes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'birthdate' => 'required|date',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        Athlete::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'age' => \Carbon\Carbon::parse($request->birthdate)->age,
            'height' => $request->height,
            'weight' => $request->weight,
        ]);

        return redirect()->route('athletes.index')->with('success', 'Data atlet berhasil ditambahkan');
    }

    // public function edit(Athlete $athlete)
    // {
    //     return view('athletes.edit', compact('athlete'));
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'birthdate' => 'required|date',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $athlete = Athlete::findOrFail($id);

        $athlete->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'age' => \Carbon\Carbon::parse($request->birthdate)->age,
            'height' => $request->height,
            'weight' => $request->weight,
        ]);

        return back()->with('success', 'Data atlet berhasil diperbarui');
    }

    public function destroy(Athlete $athlete)
    {
        $athlete->delete();
        return redirect()->route('athletes.index')->with('success', 'Data atlet berhasil dihapus.');
    }
}
