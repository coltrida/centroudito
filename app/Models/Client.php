<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function config;
use function dd;
use function substr;

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string|null $codfisc
 * @property string $indirizzo
 * @property string $citta
 * @property string $cap
 * @property string $provincia
 * @property string $telefono
 * @property int $tipologia_id
 * @property string|null $mail
 * @property string|null $recall
 * @property string|null $datarecall
 * @property string|null $datanascita
 * @property int|null $meseNascita
 * @property int|null $giornoNascita
 * @property int $marketing_id
 * @property int $user_id
 * @property int $filiale_id
 * @property int|null $recapito_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appuntamento[] $appuntamenti
 * @property-read int|null $appuntamenti_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Audiometria[] $audiometria
 * @property-read int|null $audiometria_count
 * @property-read \App\Models\Filiale $filiale
 * @property-read mixed $eta
 * @property-read mixed $fullname
 * @property-read \App\Models\Marketing $marketing
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $prova
 * @property-read int|null $prova_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $provaDdt
 * @property-read int|null $prova_ddt_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $provaFattura
 * @property-read int|null $prova_fattura_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $provaInCorso
 * @property-read int|null $prova_in_corso_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $provePassate
 * @property-read int|null $prove_passate_count
 * @property-read \App\Models\Recapito|null $recapito
 * @property-read \App\Models\Tipologia $tipologia
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Client compleanno($mese, $giorno)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCitta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCodfisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCognome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDatanascita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDatarecall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereGiornoNascita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIndirizzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMarketingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMeseNascita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRecall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRecapitoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTipologiaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUserId($value)
 * @property int|null $mese
 * @property int|null $anno
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMese($value)
 * @property string|null $telefono2
 * @property string|null $telefono3
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Documento[] $documenti
 * @property-read int|null $documenti_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelefono2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelefono3($value)
 * @property int|null $medico_id
 * @property-read \App\Models\Medico|null $medico
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereMedicoId($value)
 * @property string|null $luogoNascita
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Telefonata[] $recalls
 * @property-read int|null $recalls_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client clienti()
 * @method static \Illuminate\Database\Eloquent\Builder|Client possibili()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLuogoNascita($value)
 * @property-read mixed $fullricerca
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Informazione[] $informazione
 * @property-read int|null $informazione_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $proveSenzaDocumenti
 * @property-read int|null $prove_senza_documenti_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $proveSenzaProdotti
 * @property-read int|null $prove_senza_prodotti_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client clientidapiudianni($anni)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appuntamento[] $appuntamentisospesi
 * @property-read int|null $appuntamentisospesi_count
 * @mixin \Eloquent
 */
class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $appends = ['fullname', 'fullricerca'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipologia()
    {
        return $this->belongsTo(Tipologia::class);
    }

    public function marketing()
    {
        return $this->belongsTo(Marketing::class);
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function informazione()
    {
        return $this->hasMany(Informazione::class);
    }

    public function prova()
    {
        return $this->hasMany(Prova::class)->with('stato', 'user', 'product', 'client');
    }

    public function proveSenzaProdotti()
    {
        return $this->hasMany(Prova::class)
            ->whereDoesntHave('product');
    }

    public function proveSenzaDocumenti()
    {
        return $this->hasMany(Prova::class)->with('product')
            ->whereDoesntHave('documento');
    }

    public function provePassate()
    {
        return $this->hasMany(Prova::class)->where('stato', '!=', config('enum.statoAPA.prova'));
    }

    public function provaInCorso()
    {
        return $this->hasMany(Prova::class)->where('stato', config('enum.statoAPA.prova'));
    }

    public function scopeClientidapiudianni($query, $anni)
    {
        $annoOggi = Carbon::now()->year;
        $annoRicerca = $annoOggi - $anni;

        return $query->whereHas(['prova', function($p) use($annoRicerca){
            $p->where('anno_fine', '<', $annoRicerca)->whereHas('stato', function($q){
                $q->where('nome', 'FATTURA');
            }) ;
        }]);

        /*return $this->hasMany(Prova::class)
            ->where('anno_fine', '<', $annoRicerca)
            ->whereHas('stato', function($q){
                $q->where('nome', 'FATTURA');
        });*/
    }

    public function provaFattura()
    {
        $anno = Carbon::now()->year;
        $idStatoFattura = StatoApa::where('nome', 'FATTURA')->first()->id;
        return $this->hasMany(Prova::class)->where([ ['stato_id', $idStatoFattura], ['anno_fine', $anno] ]);
    }

    public function provaDdt()
    {
        return $this->hasMany(Prova::class)->where('stato', config('enum.statoAPA.ddt'));
    }

    public function recapito()
    {
        return $this->belongsTo(Recapito::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function appuntamenti()
    {
        return $this->hasMany(Appuntamento::class);
    }

    public function appuntamentisospesi()
    {
        return $this->hasMany(Appuntamento::class)->where('intervenuto', null);
    }

    public function audiometria()
    {
        return $this->hasMany(Audiometria::class)->latest();
    }

    public function documenti()
    {
        return $this->hasMany(Documento::class)->latest();
    }

    public function getEtaAttribute()
    {
        return $this->datanascita ? Carbon::now()->year - substr($this->datanascita, 0, 4) : null;
    }

    public function getFullnameAttribute()
    {
        return $this->cognome.' '.$this->nome;
    }

    public function getFullricercaAttribute()
    {
        return $this->cognome.' '.$this->nome.' '.$this->cognome;
    }

    public function scopeCompleanno($query, $mese, $giorno)
    {
        return $query->where([['meseNascita',$mese], ['giornoNascita', $giorno]]);
    }

    public function scopeClienti($query)
    {
        return $query->whereHas('tipologia', function ($q){
            $q->where('nome', 'CL');
        });
    }

    public function scopePossibili($query)
    {
        return $query->whereHas('tipologia', function ($q){
            $q->where('nome', 'PC');
        });
    }

    public function recalls()
    {
        return $this->hasMany(Telefonata::class);
    }
}
