<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ddt
 *
 * @property int $id
 * @property int $filiale_id
 * @property int|null $prova_id
 * @property string $nome_destinazione
 * @property string $indirizzo_destinazione
 * @property string $citta_destinazione
 * @property string $cap_destinazione
 * @property string $provincia_destinazione
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Filiale $filiale
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereCapDestinazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereCittaDestinazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereIndirizzoDestinazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereNomeDestinazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereProvaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereProvinciaDestinazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereUpdatedAt($value)
 * @property string|null $progressivo
 * @property int|null $anno
 * @property int|null $mese
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereMese($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ddt whereProgressivo($value)
 * @mixin \Eloquent
 */
class Ddt extends Model
{
    use HasFactory;

    protected $table = 'ddts';
    protected $guarded = [];

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
