<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function config;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute()
    {
        return $this->ruolo == config('enum.ruoli.admin') ? true : false;
    }

    public function getIsAudioAttribute()
    {
        return $this->ruolo == config('enum.ruoli.audio') ? true : false;
    }

    public function audiometrie()
    {
        return $this->hasMany(Audiometria::class);
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function prova()
    {
        return $this->hasMany(Prova::class);
    }
}
