<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Laporan;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            'total_pengguna' => User::count(),
            'total_pengurus' => Pengurus::count(),
            'total_kegiatan' => Kegiatan::count(),
            'total_laporan' => Laporan::count()
        ]);
    }
}
