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
        return view('admin.test_components.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'jenis' => 'required|in:fisik,teknik',
        ]);

        TestComponent::create($validated);

        return redirect()
            ->route('test_components.index')
            ->with('success', '✅ Komponen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $testComponent = TestComponent::findOrFail($id);
        return view('admin.test_components.edit', compact('testComponent'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'jenis' => 'required|in:fisik,teknik',
        ]);

        $testComponent = TestComponent::findOrFail($id);
        $testComponent->update($validated);

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
