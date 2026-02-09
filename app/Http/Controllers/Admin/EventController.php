<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
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
        $validator = [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'ketentuan' => 'nullable|string|max:255',
            'tanggal_event' => 'required|date',
            'is_active' => 'nullable|boolean',
            'lokasi' => 'nullable|string|max:255',
        ];
        $data = $request->validate($validator);
        Event::create($data);
        return redirect()->back()->with('success','Event Berhasil disimpan');
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
    public function update(Request $request, $id)
    {
        $event = Event::findorFail($id);
        if(!$event){
            return redirect()->back()->with('error','Event Tidak ditemukan');
        }
        $validator = [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'ketentuan' => 'nullable|string|max:255',
            'tanggal_event' => 'required|date',
            'is_active' => 'nullable|boolean',
            'lokasi' => 'nullable|string|max:255',
        ];
        $data = $request->validate($validator);
        $event->update($data);

        return redirect()->back()->with('success','Event Berhasil dperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $event = Event::findorFail($id);
        if(!$event){
            return redirect()->back()->with('error','Event Tidak ditemukan');
        }
        $event->delete();
        return redirect()->back()->with('success','Event Berhasil dihapus');
    }
}
