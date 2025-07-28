<?php

namespace App\Http\Controllers;

use App\Models\TestComponent;
use Illuminate\Http\Request;

class TestComponentController extends Controller
{
    public function index()
    {
        $components = TestComponent::all();
        return view('admin.test_components.index', compact('components'));
    }

    public function create()
    {
        $jenisList = TestComponent::select('jenis')->distinct()->pluck('jenis');
        return view('admin.test_components.create', compact('jenisList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'jenis' => 'required',
            'jenis_baru' => 'nullable|string|max:100',
        ]);

        $jenis = $request->jenis === 'lainnya' 
            ? strtolower($request->jenis_baru) 
            : $request->jenis;

        TestComponent::create([
            'nama_komponen' => $request->nama_komponen,
            'jenis' => $jenis,
        ]);

        return redirect()
            ->route('test_components.index')
            ->with('success', '✅ Komponen berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $testComponent = TestComponent::findOrFail($id);
        $jenisList = TestComponent::select('jenis')->distinct()->pluck('jenis');

        return view('admin.test_components.edit', compact('testComponent', 'jenisList'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'jenis' => 'required',
            'jenis_baru' => 'nullable|string|max:100',
        ]);

        $jenis = $request->jenis === 'lainnya' 
            ? strtolower($request->jenis_baru) 
            : $request->jenis;

        $testComponent = TestComponent::findOrFail($id);
        $testComponent->update([
            'nama_komponen' => $request->nama_komponen,
            'jenis' => $jenis,
        ]);

        return redirect()
            ->route('test_components.index')
            ->with('success', '✅ Komponen berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $testComponent = TestComponent::findOrFail($id);
        $testComponent->delete();

        return redirect()
            ->route('test_components.index')
            ->with('success', '🗑️ Komponen berhasil dihapus.');
    }
}
