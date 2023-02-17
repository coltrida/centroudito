<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Materiale
 *
 * @property int $id
 * @property string $nome
 * @property string $codice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereCodice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Materiale extends Model
{
    use HasFactory;
    protected $table = 'materiales';
    protected $guarded = [];
}
