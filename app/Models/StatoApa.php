<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StatoApa
 *
 * @property int $id
 * @property string $nome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatoApa whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StatoApa extends Model
{
    use HasFactory;

    protected $table = 'stato_apas';
    protected $guarded = [];
}
