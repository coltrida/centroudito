<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pezzi
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
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereAgosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereAprile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereBudgetAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereDicembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereFebbraio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereGennaio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereGiugno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereLuglio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereMaggio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereMarzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereNovembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereOttobre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereProvvigione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereSettembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereStipendio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pezzi whereUserId($value)
 * @mixin \Eloquent
 */
class Pezzi extends Model
{
    use HasFactory;
    protected $table = 'pezzis';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
