<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function config;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function prova()
    {
        return $this->hasMany(Prova::class);
    }

    public function provaInCorso()
    {
        return $this->hasMany(Prova::class)->where('stato', config('enum.statoAPA.prova'));
    }

    public function provaFattura()
    {
        return $this->hasMany(Prova::class)->where('stato', config('enum.statoAPA.fattura'));
    }

    public function recapito()
    {
        return $this->belongsTo(Recapito::class);
    }

    public function appuntamenti()
    {
        return $this->hasMany(Appuntamento::class);
    }
}
