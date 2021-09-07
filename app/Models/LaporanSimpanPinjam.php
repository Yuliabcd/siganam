<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSimpanPinjam extends Model
{
    use HasFactory;

    protected $table = 'laporan_simpan_pinjam';

    protected $fillable = [
        'laporan_id', 'saldo_awal', 'tabungan', 'jasa', 'angsuran', 'denda', 'piutang', 'saldo_akhir'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
