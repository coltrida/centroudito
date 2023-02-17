<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductProva
 *
 * @property int $id
 * @property int $prova_id
 * @property int $product_id
 * @property string|null $orecchio
 * @property string|null $prezzo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva whereOrecchio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva wherePrezzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva whereProvaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva whereUpdatedAt($value)
 * @property string|null $prezzo_formattato
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProva wherePrezzoFormattato($value)
 * @mixin \Eloquent
 */
class ProductProva extends Model
{
    use HasFactory;

    protected $table = 'product_prova';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
