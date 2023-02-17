<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ratefattura
 *
 * @property int $id
 * @property int $importo
 * @property int $fattura_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura whereFatturaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura whereImporto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratefattura whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ratefattura extends Model
{
    use HasFactory;

    protected $table = 'ratefatturas';
    protected $guarded = [];

}
