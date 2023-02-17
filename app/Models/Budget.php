<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Budget
 *
 * @property int $id
 * @property string $nome
 * @property int $user_id
 * @property int $budgetAnno
 * @property int|null $premio
 * @property int|null $stipendio
 * @property int|null $provvigione
 * @property int $gennaio
 * @property int $febbraio
 * @property int $marzo
 * @property int $aprile
 * @property int $maggio
 * @property int $giugno
 * @property int $luglio
 * @property int $agosto
 * @property int $settembre
 * @property int $ottobre
 * @property int $novembre
 * @property int $dicembre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereAgosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereAprile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereBudgetAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereDicembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereFebbraio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereGennaio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereGiugno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereLuglio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereMaggio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereMarzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereNovembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereOttobre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereProvvigione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereSettembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereStipendio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUserId($value)
 * @property int|null $anno
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereAnno($value)
 * @mixin \Eloquent
 */
class Budget extends Model
{
    use HasFactory;

    protected $table = 'budgets';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
