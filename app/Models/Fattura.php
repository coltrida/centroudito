<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fattura
 *
 * @property int $id
 * @property int|null $prova_id
 * @property string|null $data_fattura
 * @property int|null $acconto
 * @property int|null $nr_rate
 * @property int|null $tot_fattura
 * @property int|null $al_saldo
 * @property int|null $tot_fattura_scontato
 * @property int|null $sconto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Prova|null $prova
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ratefattura[] $rata
 * @property-read int|null $rata_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereAcconto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereAlSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereDataFattura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereNrRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereProvaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereSconto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereTotFattura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereTotFatturaScontato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereUpdatedAt($value)
 * @property int|null $user_id
 * @property int|null $saldata
 * @property int|null $pagata
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura wherePagata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereSaldata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereUserId($value)
 * @property string|null $ultima_rata
 * @property string|null $data_saldo
 * @property string|null $data_pagamentoAudio
 * @property int|null $pagatoAudio
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ratefattura[] $rate
 * @property-read int|null $rate_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereDataPagamentoAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereDataSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura wherePagatoAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereUltimaRata($value)
 * @property int|null $mese_fattura
 * @property int|null $anno_fattura
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereAnnoFattura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereMeseFattura($value)
 * @property int|null $progressivo
 * @method static \Illuminate\Database\Eloquent\Builder|Fattura whereProgressivo($value)
 * @mixin \Eloquent
 */
class Fattura extends Model
{
    use HasFactory;

    protected $table = 'fatturas';
    protected $guarded = [];

    public function rate()
    {
        return $this->hasMany(Ratefattura::class);
    }

    public function prova()
    {
        return $this->belongsTo(Prova::class)->with('client');
    }
}
