<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengurus extends Model
{
    use HasFactory;

    protected $table = 'laporan_pengurus';

    protected $fillable = ['laporan_id', 'pengurus_id', 'saldo_awal', 'keluar', 'masuk', 'saldo_akhir'];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
