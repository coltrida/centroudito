<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FilialeUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $filiale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FilialeUser whereUserId($value)
 * @mixin \Eloquent
 */
class FilialeUser extends Model
{
    use HasFactory;

    protected $table = 'filiale_user';
    protected $guarded = [];
}
