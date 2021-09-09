<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FotoKegiatan extends Model
{
    use HasFactory;

    protected $table = 'foto_kegiatan';

    protected $fillable = ['kegiatan_id', 'path'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function getFilenameAttribute()
    {
        if ($this->attributes['path']) {
            return basename($this->attributes['path']);
        }

        return null;
    }

    public function getSizeAttribute()
    {
        if (Storage::exists($this->attributes['path'])) {
            return Storage::size($this->attributes['path']);
        }
    
        return 0;
    }

    public function getFotoUrlAttribute()
    {
        if ($this->attributes['path']) {
            if (Str::startsWith($this->attributes['path'], 'http')) {
                return $this->attributes['path'];
            }

            return Storage::url($this->attributes['path']);
        }

        return null;
    }
}
