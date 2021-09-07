<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = ['nama', 'tempat', 'tanggal', 'jam', 'foto', 'keterangan'];

    public function fotoKegiatan()
    {
        return $this->hasMany(FotoKegiatan::class);
    }
}
