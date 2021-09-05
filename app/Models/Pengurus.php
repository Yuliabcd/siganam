<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = ['nama', 'nama_panggilan', 'jenis_kelamin', 'alamat', 'no_hp', 'email', 'foto'];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
    }

    public function laporanPengurus()
    {
        return $this->hasMany(LaporanPengurus::class);
    }
}
