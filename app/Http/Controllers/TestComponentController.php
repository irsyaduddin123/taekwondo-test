<?php

namespace App\Http\Controllers;

use App\Models\TestComponent;
use App\Models\ComponentType;
use Illuminate\Http\Request;

class TestComponentController extends Controller
{
    // ========================
    // CRUD Test Components
    // ========================
    public function index()
    {
        $components = TestComponent::with('type')->get();
        $types = ComponentType::all(); // supaya bisa ditampilkan di view

        return view('admin.test_components.index', compact('components', 'types'));
    }

    public function createComponent()
    {
        $jenisList = ComponentType::pluck('nama_jenis', 'id'); // [id => nama]
        return view('admin.test_components.create', compact('jenisList'));
    }

    public function storeComponent(Request $request)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'jenis_id'      => 'required|exists:component_types,id',
            'deskripsi'     => 'nullable|string',
        ]);

        TestComponent::create($request->only(['nama_komponen', 'jenis_id', 'deskripsi']));

        return redirect()->route('test_components.index')
                         ->with('success', '✅ Komponen tes berhasil ditambahkan!');
    }

    public function editComponent($id)
    {
        $component  = TestComponent::findOrFail($id);
        $jenisList  = ComponentType::pluck('nama_jenis', 'id');

        return view('admin.test_components.edit', compact('component', 'jenisList'));
    }

    public function updateComponent(Request $request, $id)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:255',
            'jenis_id'      => 'required|exists:component_types,id',
            'deskripsi'     => 'nullable|string',
        ]);

        $component = TestComponent::findOrFail($id);
        $component->update($request->only(['nama_komponen', 'jenis_id', 'deskripsi']));

        return redirect()->route('test_components.index')
                         ->with('success', '✅ Komponen tes berhasil diperbarui!');
    }

    public function destroyComponent($id)
    {
        TestComponent::findOrFail($id)->delete();

        return back()->with('success', '🗑️ Komponen tes berhasil dihapus.');
    }

    // ========================
    // CRUD Component Types
    // ========================
    public function storeType(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:component_types,nama_jenis',
        ]);

        ComponentType::create(['nama_jenis' => $request->nama_jenis]);

        return back()->with('success', '✅ Jenis komponen berhasil ditambahkan.');
    }

    public function updateType(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:component_types,nama_jenis,' . $id,
        ]);

        $type = ComponentType::findOrFail($id);
        $type->update(['nama_jenis' => $request->nama_jenis]);

        return back()->with('success', '✅ Jenis komponen berhasil diperbarui.');
    }

    public function destroyType($id)
    {
        ComponentType::findOrFail($id)->delete();

        return back()->with('success', '🗑️ Jenis komponen berhasil dihapus.');
    }
}
