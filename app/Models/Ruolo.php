<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ruolo
 *
 * @property int $id
 * @property string $nome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruolo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ruolo extends Model
{
    use HasFactory;

    protected $table = 'ruolos';
    protected $guarded = [];
}
