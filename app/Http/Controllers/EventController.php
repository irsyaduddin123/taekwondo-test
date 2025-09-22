<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Plan;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Tampilkan daftar event.
     */
    public function index()
    {
        $events = Event::orderBy('tanggal_mulai', 'asc')->get();
        $plans  = Plan::orderBy('tahun', 'desc')->get();

        return view('admin.anual-plan.events.index', compact('events', 'plans'));
    }

    /**
     * Simpan event baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id'         => 'required|exists:plans,id',
            'nama'            => 'required|string|max:255',
            'lokasi'          => 'nullable|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string',
        ]);

        Event::create($request->only([
            'plan_id','nama','lokasi','tanggal_mulai','tanggal_selesai','keterangan'
        ]));

        return redirect()->back()->with('success', 'Event berhasil ditambahkan.');
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'plan_id'         => 'required|exists:plans,id',
            'nama'            => 'required|string|max:255',
            'lokasi'          => 'nullable|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string',
        ]);

        $event->update($request->only([
            'plan_id','nama','lokasi','tanggal_mulai','tanggal_selesai','keterangan'
        ]));

        return redirect()->back()->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Hapus event.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus.');
    }
}
