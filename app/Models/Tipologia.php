<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tipologia
 *
 * @property int $id
 * @property string $nome
 * @property int|null $recall
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia whereRecall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipologia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tipologia extends Model
{
    use HasFactory;

    protected $table = 'tipologias';
    protected $guarded = [];
}
