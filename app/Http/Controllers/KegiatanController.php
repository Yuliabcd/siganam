<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kegiatan\KegiatanStoreRequest;
use App\Http\Requests\Kegiatan\KegiatanUpdateRequest;
use App\Models\FotoKegiatan;
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
        return view('kegiatan.index')->with(['kegiatan' => Kegiatan::latest()->paginate(10)]);
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
    public function store(KegiatanStoreRequest $request)
    {

        $validated = $request->validated();
        $validated['foto'] = $request->file('foto')->store('images/kegiatan', 'public');

        Kegiatan::create($validated);

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
    public function update(KegiatanUpdateRequest $request, Kegiatan $kegiatan)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/kegiatan', 'public');
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

    public function uploadFoto(Request $request, $id)
    {
        abort_unless($request->ajax(), 404);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/kegiatan', 'public');
            FotoKegiatan::create([
                'kegiatan_id' => $id,
                'path' => $path
            ]);

            return response()->json(['message' => 'OK']);
        }

        return response()->json(['message' => 'Invalid request'], 422);
    }

    public function deleteFoto(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $request->validate([
            'foto_id' => 'required|numeric|exists:foto_kegiatan,id'
        ]);

        $foto = FotoKegiatan::findOrFail($request->foto_id);
        Storage::disk('public')->delete($foto->path);
        $foto->delete();

        return response()->json(['message' => 'OK'], 204);
    }
}
