<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function setlocale;
use const LC_TIME;

class Prova extends Model
{
    use HasFactory;

    protected $table = 'provas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /*public function listino()
    {
        return $this->belongsToMany(Listino::class, 'product_prova', 'prova_id', 'product_id');
    }*/

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_prova', 'prova_id', 'product_id')
            ->withPivot('prezzo');
    }

    public function fattura()
    {
        return $this->hasOne(Fattura::class);
    }

    public function getGiorniInProvaAttribute()
    {
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');

        $created = new Carbon($this->inizio_prova);
        $now = Carbon::now();
        $difference = ($created->diff($now)->days < 1)
            ? '0'
            : $created->diff($now)->days;
        return $difference;
        //return Carbon::make($this->inizio_prova)->diffForHumans();
    }
}
