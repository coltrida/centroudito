<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function setlocale;
use const LC_TIME;

/**
 * App\Models\Prova
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $client_id
 * @property int|null $filiale_id
 * @property string|null $tot
 * @property int|null $stato_id
 * @property string|null $inizio_prova
 * @property string|null $fine_prova
 * @property int|null $mese_fine
 * @property int|null $anno_fine
 * @property int|null $mese_inizio
 * @property int|null $anno_inizio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Ddt|null $ddt
 * @property-read \App\Models\Fattura|null $fattura
 * @property-read mixed $giorni_in_prova
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @property-read \App\Models\StatoApa|null $stato
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Prova finaliz()
 * @method static \Illuminate\Database\Eloquent\Builder|Prova newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prova newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prova query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereAnnoFine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereAnnoInizio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereFineProva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereInizioProva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereMeseFine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereMeseInizio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereStatoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereTot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereUserId($value)
 * @property int|null $marketing_id
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereMarketingId($value)
 * @property int|null $giorni_prova
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereGiorniProva($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Documento[] $copiaComm
 * @property-read int|null $copia_comm_count
 * @property-read mixed $tot_formattato
 * @property-read mixed $fine_formattata
 * @property string|null $tipologia
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Documento[] $documento
 * @property-read int|null $documento_count
 * @property-read \App\Models\Marketing|null $marketing
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereTipologia($value)
 * @property int|null $progressivo
 * @property string|null $mercato
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereMercato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prova whereProgressivo($value)
 * @mixin \Eloquent
 */
class Prova extends Model
{
    use HasFactory;

    protected $table = 'provas';
    protected $guarded = [];
    protected $appends = ['tot_formattato', 'fine_formattata'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function marketing()
    {
        return $this->belongsTo(Marketing::class);
    }

    public function copiaComm()
    {
        return $this->hasMany(Documento::class)->where('tipo', 'copiaComm');
    }

    public function stato()
    {
        return $this->belongsTo(StatoApa::class, 'stato_id', 'id');
    }

    /*public function listino()
    {
        return $this->belongsToMany(Listino::class, 'product_prova', 'prova_id', 'product_id');
    }*/

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_prova', 'prova_id', 'product_id')
            ->withPivot('prezzo','prezzo_formattato')->with('listino');
    }

    public function documento()
    {
        return $this->hasMany(Documento::class);
    }

    public function fattura()
    {
        return $this->hasOne(Fattura::class);
    }

    public function ddt()
    {
        return $this->hasOne(Ddt::class);
    }

    public function getTotFormattatoAttribute()
    {
        return $this->tot ? '€ '.number_format( (float) $this->tot, '0', ',', '.') : null;
    }

    public function getFineFormattataAttribute()
    {
        return $this->fine_prova ? Carbon::make($this->fine_prova)->format('d-m-Y') : null;
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

    public function scopeFinaliz($query)
    {
        return $query->groupBy('client_id');
    }
}
