<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pengurus\PengurusStoreRequest;
use App\Http\Requests\Pengurus\PengurusUpdateRequest;
use App\Models\Pengurus;
use App\Models\Posisi;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengurus.index')->with(['pengurus' => Pengurus::orderBy('posisi_id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengurus.create')->with(['posisi' => Posisi::all()->pluck('nama', 'id')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengurusStoreRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/pengurus', 'public');
        }

        Pengurus::create($validated);

        return redirect()->route('penguruses.index')->withSuccess('Berhasil menambahkan pengurus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurus $pengurus)
    {
        return view('pengurus.show', compact('pengurus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengurus $pengurus)
    {
        $posisi = Posisi::all()->pluck('nama', 'id');
        return view('pengurus.edit', compact('pengurus', 'posisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function update(PengurusUpdateRequest $request, Pengurus $pengurus)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/pengurus', 'public');
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->update($validated);

        return back()->withSuccess('Pengurus berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengurus $pengurus)
    {
        Storage::disk('public')->delete($pengurus->foto);
        $pengurus->delete();

        return back()->withSuccess('Pengurus Berhasil diupdate');
    }
}
