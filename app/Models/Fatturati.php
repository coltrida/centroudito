<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fatturati
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $user_id
 * @property int|null $budgetAnno
 * @property int|null $premio
 * @property int|null $stipendio
 * @property int|null $provvigione
 * @property int|null $gennaio
 * @property int|null $febbraio
 * @property int|null $marzo
 * @property int|null $aprile
 * @property int|null $maggio
 * @property int|null $giugno
 * @property int|null $luglio
 * @property int|null $agosto
 * @property int|null $settembre
 * @property int|null $ottobre
 * @property int|null $novembre
 * @property int|null $dicembre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereAgosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereAprile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereBudgetAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereDicembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereFebbraio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereGennaio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereGiugno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereLuglio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereMaggio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereMarzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereNovembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereOttobre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereProvvigione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereSettembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereStipendio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereUserId($value)
 * @property int|null $asl
 * @property int|null $binaurale
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereAsl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereBinaurale($value)
 * @property int|null $anno
 * @method static \Illuminate\Database\Eloquent\Builder|Fatturati whereAnno($value)
 * @mixin \Eloquent
 */
class Fatturati extends Model
{
    use HasFactory;
    protected $table = 'fatturatis';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
