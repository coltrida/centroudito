<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Listino
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $fornitore_id
 * @property int|null $categoria_id
 * @property string|null $costo
 * @property string|null $prezzolistino
 * @property string|null $iva
 * @property string|null $giorniTempoDiReso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categoria|null $categoria
 * @property-read \App\Models\Fornitore|null $fornitore
 * @method static \Illuminate\Database\Eloquent\Builder|Listino fromfornitore($idFornitore)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listino newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listino query()
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereFornitoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereGiorniTempoDiReso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino wherePrezzolistino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Filiale[] $filiale
 * @property-read int|null $filiale_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|Listino apparecchi()
 * @property int|null $scontoMax
 * @method static \Illuminate\Database\Eloquent\Builder|Listino whereScontoMax($value)
 * @mixin \Eloquent
 */
class Listino extends Model
{
    use HasFactory;

    protected $table = 'listinos';
    protected $guarded = [];

    public function fornitore()
    {
        return $this->belongsTo(Fornitore::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeFromfornitore($query, $idFornitore)
    {
        return $query->where('fornitore_id', $idFornitore)->whereHas('categoria', function ($q){
            $q->where('nome', '!=', 'SERV');
        });
    }

    public function scopeApparecchi($query)
    {
        return $query->whereHas('categoria', function ($stato){
            $stato->where('nome', 'APA');
        });
    }

    public function filiale()
    {
        return $this->belongsToMany(Filiale::class)->withPivot('soglia');
    }

    /*public function filialeById()
    {
        return $this->belongsToMany(Filiale::find($id))->withPivot('soglia');
    }*/
}
