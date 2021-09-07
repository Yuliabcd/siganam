<?php

namespace App\Http\Controllers;

use App\Models\LaporanPengurus;
use Illuminate\Http\Request;

class LaporanPengurusController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => ['numeric', 'required', 'exists:laporan,id'],
            'saldo_awal'  => ['nullable', 'numeric'],
            'keluar'  => ['nullable', 'numeric'],
            'masuk'  => ['nullable', 'numeric'],
            'saldo_akhir'  => ['nullable', 'numeric'],
        ]);

        LaporanPengurus::create($request->all());

        return back()->withSuccess('Berhasil menambahkan laporan pengurus');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanPengurus $laporanPengurus)
    {
        abort_if(!request()->ajax(), 404);
        return response()->json($laporanPengurus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanPengurus $laporanPengurus)
    {
        $request->validate([
            'laporan_id' => ['numeric', 'required', 'exists:laporan,id'],
            'saldo_awal'  => ['nullable', 'numeric'],
            'keluar'  => ['nullable', 'numeric'],
            'masuk'  => ['nullable', 'numeric'],
            'saldo_akhir'  => ['nullable', 'numeric'],
        ]);

        $laporanPengurus->update($request->all());

        return back()->withSuccess('Laporan pengurus berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanPengurus $laporanPengurus)
    {
        $laporanPengurus->delete();
        return back()->withSuccess('Laporan pengurus berhasil dihapus');
    }
}
