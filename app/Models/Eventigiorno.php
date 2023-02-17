<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Eventigiorno
 *
 * @property int $id
 * @property int $user_id
 * @property string $quando
 * @property string $giorno
 * @property string $cosa
 * @property string|null $evento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno query()
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereCosa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereEvento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereGiorno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereQuando($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eventigiorno whereUserId($value)
 * @mixin \Eloquent
 */
class Eventigiorno extends Model
{
    use HasFactory;
    protected $table = 'eventigiornos';
    protected $guarded = [];
}
