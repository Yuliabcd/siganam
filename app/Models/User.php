<?php

namespace App\Models;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'foto',
        'no_hp',
        'alamat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFotoUrlAttribute()
    {
        if ($this->attributes['foto'] === null) {
            return  'https://dukcapil.klatenkab.go.id/assets/img/user.png';
        }

        return  Storage::url($this->attributes['foto']);
    }

    public function getRoleAttribute()
    {
        if ($this->roles->isNotEmpty()) {
            return $this->roles->first()->name;
        }

        return null;
    }
}
