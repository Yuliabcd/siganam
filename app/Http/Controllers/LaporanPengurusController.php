<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanPengurus\LaporanPengurusStoreRequest;
use App\Http\Requests\LaporanPengurus\LaporanPengurusUpdateRequest;
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
    public function store(LaporanPengurusStoreRequest $request)
    {
        LaporanPengurus::create($request->validated());
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
        abort_unless(request()->ajax(), 404);
        return response()->json($laporanPengurus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanPengurusUpdateRequest $request, LaporanPengurus $laporanPengurus)
    {
        $laporanPengurus->update($request->validated());
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
