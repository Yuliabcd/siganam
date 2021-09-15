<?php

namespace App\Http\Controllers;

use App\Http\Requests\Laporan\LaporanStoreRequest;
use App\Http\Requests\Laporan\LaporanUpdateRequest;
use App\Http\Requests\LaporanSimpanPinjamUpdateRequest;
use App\Models\Laporan;
use App\Models\LaporanPengurus;
use App\Models\LaporanSimpanPinjam;
use App\Models\Pengurus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.index')->with(['laporan' => Laporan::latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $laporan = Laporan::create($request->validated());
            LaporanSimpanPinjam::create(['laporan_id' => $laporan->id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('laporan.edit', $laporan->id)->withSuccess('Berhasil menambahkan laporan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {

        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        $pengurus = Pengurus::orderBy('posisi_id')->get();
        return view('laporan.edit', compact('laporan', 'pengurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanUpdateRequest $request, Laporan $laporan)
    {
        $laporan->update($request->validated());
        return back()->withSuccess('Laporan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return back()->withSuccess('Laporan berhasil dihapus');
    }

    public function updateLaporanSimpanPinjam(LaporanSimpanPinjamUpdateRequest $request, LaporanSimpanPinjam $laporanSimpanPinjam)
    {
        $laporanSimpanPinjam->update($request->validated());
        return back()->withSuccess('Laporan simpan pinjam berhasil diupdate');
    }
}
