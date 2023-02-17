<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function setlocale;
use const LC_TIME;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $matricola
 * @property int|null $stato_id
 * @property int|null $filiale_id
 * @property int|null $listino_id
 * @property int|null $user_id
 * @property int|null $client_id
 * @property int|null $fornitore_id
 * @property int|null $ddt_id
 * @property int|null $fattura_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Ddt|null $ddt
 * @property-read \App\Models\Filiale|null $filiale
 * @property-read \App\Models\Fornitore|null $fornitore
 * @property-read mixed $giorni_in_prova
 * @property-read \App\Models\Listino|null $listino
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $prova
 * @property-read int|null $prova_count
 * @property-read \App\Models\StatoApa|null $stato
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Product arrivo()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product richiesto()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDdtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFatturaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFornitoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereListinoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMatricola($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @property-read \App\Models\Fattura|null $fattura
 * @property string|null $datacarico
 * @property int|null $pericoloRestituzione
 * @method static \Illuminate\Database\Eloquent\Builder|Product apparecchi()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDatacarico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePericoloRestituzione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product filiale()
 * @method static \Illuminate\Database\Eloquent\Builder|Product prova()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function prova()
    {
        return $this->belongsToMany(Prova::class, 'product_prova', 'product_id', 'prova_id')
            ->withPivot('prezzo');
    }

    public function listino()
    {
        return $this->belongsTo(Listino::class);
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function stato()
    {
        return $this->belongsTo(StatoApa::class, 'stato_id', 'id');
    }

    public function scopeFiliale($query)
    {
        return $query->whereHas('stato', function ($stato){
            $stato->where('nome', 'FILIALE');
        });
    }

    public function scopeProva($query)
    {
        return $query->whereHas('stato', function ($stato){
            $stato->where('nome', 'PROVA');
        });
    }

    public function scopeRichiesto($query)
    {
        return $query->whereHas('stato', function ($stato){
            $stato->where('nome', 'RICHIESTO');
        });
    }

    public function scopeArrivo($query)
    {
        return $query->whereHas('stato', function ($stato){
            $stato->where('nome', 'DDT');
        });
    }

    public function fornitore()
    {
        return $this->belongsTo(Fornitore::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function ddt()
    {
        return $this->belongsTo(Ddt::class);
    }

    public function getGiorniInProvaAttribute()
    {
        $now = Carbon::now();
        //return $this->created_at->diff($now)->days;
        return $this->listino->giorniTempoDiReso - $this->created_at->diff($now)->days;
    }

    public function fattura()
    {
        return $this->belongsTo(Fattura::class);
    }

    public function scopeApparecchi($query)
    {
        return $query->whereHas('listino', function ($stato){
            $stato->whereHas('categoria', function ($cat){
                $cat->where('nome', 'APA');
            });
        });
    }
}
