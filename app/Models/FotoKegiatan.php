<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKegiatan extends Model
{
    use HasFactory;

    protected $table = 'foto_kegiatan';

    protected $fillable = ['path'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
