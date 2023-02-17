<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Delta
 *
 * @property int $id
 * @property string|null $nome
 * @property int|null $user_id
 * @property float|null $budgetAnno
 * @property float|null $premio
 * @property float|null $stipendio
 * @property float|null $provvigione
 * @property float|null $gennaio
 * @property float|null $febbraio
 * @property float|null $marzo
 * @property float|null $aprile
 * @property float|null $maggio
 * @property float|null $giugno
 * @property float|null $luglio
 * @property float|null $agosto
 * @property float|null $settembre
 * @property float|null $ottobre
 * @property float|null $novembre
 * @property float|null $dicembre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Delta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereAgosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereAprile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereBudgetAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereDicembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereFebbraio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereGennaio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereGiugno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereLuglio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereMaggio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereMarzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereNovembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereOttobre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereProvvigione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereSettembre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereStipendio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereUserId($value)
 * @property int|null $anno
 * @method static \Illuminate\Database\Eloquent\Builder|Delta whereAnno($value)
 * @mixin \Eloquent
 */
class Delta extends Model
{
    use HasFactory;
    protected $table = 'deltas';
    protected $guarded = [];
}
