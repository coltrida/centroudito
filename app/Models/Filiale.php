<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function config;

/**
 * App\Models\Filiale
 *
 * @property int $id
 * @property string $nome
 * @property string $indirizzo
 * @property string $citta
 * @property string $telefono
 * @property string $cap
 * @property string $provincia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $audioprot
 * @property-read int|null $audioprot_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $productsImmatricolati
 * @property-read int|null $products_immatricolati_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $productsRichiesti
 * @property-read int|null $products_richiesti_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereCitta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereIndirizzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Listino[] $listino
 * @property-read int|null $listino_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Strumentazione[] $strumentazione
 * @property-read int|null $strumentazione_count
 * @property string|null $codiceIdentificativo
 * @property string|null $informazioni
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereCodiceIdentificativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiale whereInformazioni($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $productsInArrivo
 * @property-read int|null $products_in_arrivo_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $productsInProva
 * @property-read int|null $products_in_prova_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $productsPresenti
 * @property-read int|null $products_presenti_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Richiesta[] $richieste
 * @property-read int|null $richieste_count
 * @mixin \Eloquent
 */
class Filiale extends Model
{
    use HasFactory;

    protected $table = 'filiales';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'filiale_user', 'filiale_id', 'user_id')
            ->withPivot(['id']);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'filiale_id', 'id');
    }

    public function prove()
    {
        return $this->hasMany(Prova::class, 'filiale_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class)
            ->whereHas('listino.categoria', function ($q){
                $q->where('nome', '!=', 'SERV');
        });
    }

    public function productsPresenti()
    {
        return $this->hasMany(Product::class)
            ->whereHas('listino.categoria', function ($q){
                $q->where('nome', '!=', 'SERV');
            })
            ->whereHas('stato', function ($q){
                $q->where('nome', 'FILIALE');
            });
    }

    public function productsInProva()
    {
        return $this->hasMany(Product::class)
            ->whereHas('listino.categoria', function ($q){
                $q->where('nome', '!=', 'SERV');
            })
            ->whereHas('stato', function ($q){
                $q->where('nome', 'PROVA');
            });
    }

    public function productsRichiesti()
    {
        return $this->hasMany(Product::class)
            ->whereHas('listino.categoria', function ($q){
                $q->where('nome', '!=', 'SERV');
            })
            ->whereHas('stato', function ($q){
                $q->where('nome', 'RICHIESTO');
            });
    }

    public function productsInArrivo()
    {
        return $this->hasMany(Product::class)
            ->whereHas('listino.categoria', function ($q){
                $q->where('nome', '!=', 'SERV');
            })
            ->whereHas('stato', function ($q){
                $q->where('nome', 'DDT');
            });
    }

    public function strumentazione()
    {
        return $this->hasMany(Strumentazione::class);
    }


    public function productsImmatricolati()
    {
        return $this->hasMany(Product::class)->where('stato_id', 8);
    }

    public function audioprot()
    {
        return $this->belongsToMany(User::class, 'filiale_user', 'filiale_id', 'user_id')
            ->where('ruolo_id', 2)
            ->with('budget')
            ->withPivot(['id']);
    }

    public function listino()
    {
        return $this->belongsToMany(Listino::class)->withPivot('soglia');
    }

    public function richieste()
    {
        return $this->hasMany(Richiesta::class);
    }
}
