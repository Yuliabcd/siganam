<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = ['tanggal', 'tempat', 'informasi', 'serap_info'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function laporanPengurus()
    {
        return $this->hasMany(LaporanPengurus::class);
    }

    public function laporanSimpanPinjam()
    {
        return $this->hasOne(LaporanSimpanPinjam::class);
    }
}
