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
        return view('athletes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'height' => 'required',
            'weight' => 'required',
        ]);

        Athlete::create($request->all());
        return redirect()->route('admin.athletes.index')->with('success', 'Data atlet berhasil ditambahkan.');
    }

    public function edit(Athlete $athlete)
    {
        return view('athletes.edit', compact('athlete'));
    }

    public function update(Request $request, Athlete $athlete)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'height' => 'required',
            'weight' => 'required',
        ]);

        $athlete->update($request->all());
        return redirect()->route('admin.athletes.index')->with('success', 'Data atlet berhasil diperbarui.');
    }

    public function destroy(Athlete $athlete)
    {
        $athlete->delete();
        return redirect()->route('admin.athletes.index')->with('success', 'Data atlet berhasil dihapus.');
    }
}
