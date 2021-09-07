<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Posisi;
use Illuminate\Http\Request;
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
        return view('pengurus.index')->with(['pengurus' => Pengurus::orderBy('posisi_id')->paginate(15)]);
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
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'posisi_id' => ['numeric', 'required', 'exists:posisi,id'],
            'nama' => ['string', 'required', 'max:50'],
            'nama_panggilan' => ['string', 'required', 'max:50'],
            'jenis_kelamin' => ['in:l,p', 'required'],
            'email' => ['email', 'nullable', 'max:50'],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'nullable', 'max:1024'],
            'no_hp' => ['string', 'nullable', 'max:15', 'starts_with:08,62,+62'],
            'alamat' => ['string', 'nullable', 'max:500'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images', 'public');
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
    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $this->validate($request, [
            'posisi_id' => ['numeric', 'required', 'exists:posisi,id'],
            'nama' => ['string', 'required', 'max:50'],
            'nama_panggilan' => ['string', 'required', 'max:50'],
            'jenis_kelamin' => ['in:l,p', 'required'],
            'email' => ['email', 'nullable', 'max:50'],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'nullable', 'max:1024'],
            'no_hp' => ['string', 'nullable', 'max:15', 'starts_with:08,62,+62'],
            'alamat' => ['string', 'nullable', 'max:500'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images', 'public');
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
