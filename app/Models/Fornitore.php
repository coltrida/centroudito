<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fornitore
 *
 * @property int $id
 * @property string $nome
 * @property string|null $indirizzo
 * @property string|null $citta
 * @property string|null $cap
 * @property string|null $provincia
 * @property string|null $telefono
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $univoco
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Listino[] $listino
 * @property-read int|null $listino_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereCitta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereIndirizzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore wherePec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereUnivoco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fornitore whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fornitore extends Model
{
    use HasFactory;

    protected $table = 'fornitores';
    protected $guarded = [];

    public function listino()
    {
        return $this->hasMany(Listino::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
