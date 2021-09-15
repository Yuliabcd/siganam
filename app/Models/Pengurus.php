<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = ['posisi_id', 'nama', 'nama_panggilan', 'jenis_kelamin', 'alamat', 'no_hp', 'email', 'foto'];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
    }

    public function laporanPengurus()
    {
        return $this->hasMany(LaporanPengurus::class);
    }

    public function getJenisKelaminTextAttribute()
    {
        if ($this->attributes['jenis_kelamin'] === 'l') {
            return 'Laki-Laki';
        }
        return 'Perempuan';
    }

    public function getFotoUrlAttribute()
    {
        if ($this->attributes['foto'] === null) {
            return asset('assets/image/user.png');
        }

        return  Storage::url($this->attributes['foto']);
    }
}
