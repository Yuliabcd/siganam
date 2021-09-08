<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kegiatan.index')->with(['kegiatan' => Kegiatan::latest()->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kegiatan.create');
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
            'nama' => ['string', 'required', 'max:200'],
            'tempat' => ['string', 'required', 'max:300'],
            'tanggal' => ['date_format:Y-m-d', 'before_or_equal:' . date('Y-m-d'), 'required'],
            'jam' => ['nullable'],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'required', 'max:1024'],
            'keterangan' => ['string', 'nullable', 'max:500']
        ]);

        $validated['foto'] = $request->file('foto')->store('images', 'public');

        $kegiatan = Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')->withSuccess('Berhasil menamahkan kegiatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $this->validate($request, [
            'nama' => ['string', 'required', 'max:200'],
            'tempat' => ['string', 'required', 'max:300'],
            'tanggal' => ['date_format:Y-m-d', 'before_or_equal:' . date('Y-m-d'), 'required'],
            'jam' => ['nullable'],
            'foto' => ['file', 'mimes:jpg,jpeg,png', 'nullable', 'max:1024'],
            'keterangan' => ['string', 'nullable', 'max:500']
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images', 'public');
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->update($validated);

        return back()->withSuccess('Kegiatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        Storage::disk('public')->delete($kegiatan->foto);
        $fotoKegiatan = $kegiatan->fotoKegiatan->map(function ($foto) {
            return $foto->path;
        })->toArray();

        Storage::disk('public')->delete($fotoKegiatan);
        $kegiatan->delete();

        return back()->withSuccess('Kegiatan berhasil dihapus');
    }

    public function uploadImage(Request $request, $id)
    {
    }
}
