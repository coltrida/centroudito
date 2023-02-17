<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Risultatitel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel query()
 * @property int $id
 * @property string $mese
 * @property int $mesenumero
 * @property int $anno
 * @property int $telefonate
 * @property int $appuntamenti
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereAppuntamenti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereMese($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereMesenumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereTelefonate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereUpdatedAt($value)
 * @property int|null $user_id
 * @property int|null $intervenuti
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereIntervenuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Risultatitel whereUserId($value)
 * @mixin \Eloquent
 */
class Risultatitel extends Model
{
    use HasFactory;
    protected $table = 'risultatitels';
    protected $guarded = [];
}
