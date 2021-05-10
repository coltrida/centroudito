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

    public function getIsAmministrazioneAttribute()
    {
        return $this->ruolo == config('enum.ruoli.segreteria') ? true : false;
    }

    public function audiometrie()
    {
        return $this->hasMany(Audiometria::class);
    }

    public function filiale()
    {
        return $this->belongsToMany(Filiale::class, 'filiale_user', 'user_id', 'filiale_id');
    }

    public function prova()
    {
        return $this->hasMany(Prova::class);
    }

    public function provaInCorso()
    {
        return $this->hasMany(Prova::class)->where('stato', config('enum.statoAPA.prova'));
    }

    public function provaFinalizzata()
    {
        return $this->hasMany(Prova::class)->where('stato', config('enum.statoAPA.fattura'));
    }

    public function recapito()
    {
        return $this->hasMany(Recapito::class);
    }

    public function appuntamenti()
    {
        return $this->hasMany(Appuntamento::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function client()
    {
        return $this->hasMany(Client::class);
    }
}
